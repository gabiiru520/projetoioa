<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Course;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class IoaNatalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    /** @test */
    public function public_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('IOA');
        $response->assertSee('Natal');
    }

    /** @test */
    public function about_page_loads_successfully(): void
    {
        $response = $this->get('/sobre');
        $response->assertStatus(200);
        $response->assertSee('Sobre o IOA Natal');
    }

    /** @test */
    public function courses_catalog_and_detail_load(): void
    {
        $response = $this->get('/cursos');
        $response->assertStatus(200);
        $response->assertSee('Nossos Cursos');

        $course = Course::first();
        $this->assertNotNull($course);
        $detailResponse = $this->get('/cursos/' . $course->slug);
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee($course->title);
    }

    /** @test */
    public function turmas_page_loads(): void
    {
        $response = $this->get('/turmas');
        $response->assertStatus(200);
        $response->assertSee('Turmas');
    }

    /** @test */
    public function portfolio_page_loads(): void
    {
        $response = $this->get('/portfolio');
        $response->assertStatus(200);
        $response->assertSee('Portfólio');
    }

    /** @test */
    public function blog_and_post_detail_load(): void
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertSee('Blog IOA Natal');

        $post = Post::published()->first();
        $this->assertNotNull($post);
        $postResponse = $this->get('/blog/' . $post->slug);
        $postResponse->assertStatus(200);
        $postResponse->assertSee($post->title);
    }

    /** @test */
    public function contact_page_loads_and_form_submits(): void
    {
        $response = $this->get('/contato');
        $response->assertStatus(200);
        $response->assertSee('Fale com Nossos Consultores');

        $formData = [
            'name' => 'Dra. Patricia Medeiros',
            'email' => 'patricia.medeiros@gmail.com',
            'phone' => '(84) 99111-2233',
            'course_of_interest' => 'Especialização em Harmonização Orofacial (HOF) Avançada e Anatomia Cirúrgica',
            'message' => 'Gostaria de agendar uma visita e saber mais sobre a turma de HOF.',
        ];

        $postResponse = $this->post('/contato', $formData);
        $postResponse->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'patricia.medeiros@gmail.com',
        ]);
    }

    /** @test */
    public function admin_login_and_authenticated_access(): void
    {
        $loginPage = $this->get('/admin/login');
        $loginPage->assertStatus(200);
        $loginPage->assertSee('Painel de Gestão');

        $admin = User::where('email', 'admin@ioanatal.com.br')->first();
        $this->assertNotNull($admin);

        // Try login
        $loginAttempt = $this->post('/admin/login', [
            'email' => 'admin@ioanatal.com.br',
            'password' => 'admin123456',
        ]);
        $loginAttempt->assertRedirect(route('admin.dashboard'));

        // Access dashboard as admin
        $dashboardResponse = $this->actingAs($admin)->get('/admin');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Cursos Cadastrados');

        // Access courses CMS
        $coursesAdmin = $this->actingAs($admin)->get('/admin/courses');
        $coursesAdmin->assertStatus(200);

        // Access settings CMS
        $settingsAdmin = $this->actingAs($admin)->get('/admin/settings');
        $settingsAdmin->assertStatus(200);
    }
}
