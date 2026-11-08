<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CourseTeamMemberTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    private function getAdminUser(): User
    {
        return User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);
    }

    public function test_can_link_courses_when_creating_team_member(): void
    {
        $admin = $this->getAdminUser();
        $course1 = Course::first();
        $course2 = Course::skip(1)->first() ?? Course::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.team.store'), [
            'name' => 'Prof. Dr. Novo Docente',
            'role' => 'Especialista em Endodontia',
            'cro' => 'CRO-RN 9999',
            'bio' => 'Biografia de teste',
            'is_active' => '1',
            'sort_order' => 10,
            'courses' => [$course1->id, $course2->id],
        ]);

        $response->assertRedirect(route('admin.team.index'));

        $member = TeamMember::where('name', 'Prof. Dr. Novo Docente')->first();
        $this->assertNotNull($member);
        $this->assertEquals(2, $member->courses()->count());
        $this->assertTrue($member->courses->contains($course1->id));
        $this->assertTrue($member->courses->contains($course2->id));
    }

    public function test_can_update_course_links_for_existing_team_member(): void
    {
        $admin = $this->getAdminUser();
        $member = TeamMember::first();
        $courses = Course::take(2)->get();

        // Initially link to two courses
        $member->courses()->sync($courses->pluck('id')->toArray());
        $this->assertEquals(2, $member->fresh()->courses->count());

        // Update to only link to first course
        $response = $this->actingAs($admin)->put(route('admin.team.update', $member->id), [
            'name' => $member->name,
            'role' => $member->role,
            'cro' => $member->cro,
            'bio' => $member->bio,
            'is_active' => '1',
            'sort_order' => $member->sort_order,
            'courses' => [$courses[0]->id],
        ]);

        $response->assertRedirect(route('admin.team.index'));
        $memberFresh = $member->fresh(['courses']);
        $this->assertEquals(1, $memberFresh->courses->count());
        $this->assertTrue($memberFresh->courses->contains($courses[0]->id));
        $this->assertFalse($memberFresh->courses->contains($courses[1]->id));
    }

    public function test_public_course_page_displays_linked_active_professors(): void
    {
        $course = Course::first();
        $activeMember = TeamMember::first();
        $activeMember->update(['is_active' => true]);

        $inactiveMember = TeamMember::skip(1)->first();
        $inactiveMember->update(['is_active' => false]);

        $course->teamMembers()->sync([$activeMember->id, $inactiveMember->id]);

        $response = $this->get(route('courses.show', $course->slug));
        $response->assertStatus(200);
        $response->assertSee('Professores deste Curso');
        $response->assertSee($activeMember->name);
        $response->assertDontSee($inactiveMember->name);
    }

    public function test_public_course_page_hides_section_when_no_professors_linked(): void
    {
        $course = Course::first();
        $course->teamMembers()->detach();

        $response = $this->get(route('courses.show', $course->slug));
        $response->assertStatus(200);
        $response->assertDontSee('Professores deste Curso');
    }
}
