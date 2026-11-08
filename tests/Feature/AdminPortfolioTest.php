<?php

namespace Tests\Feature;

use App\Models\PortfolioItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPortfolioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        \Illuminate\Support\Facades\Artisan::call('db:seed');
    }

    public function test_can_update_portfolio_item_with_new_image(): void
    {
        Storage::fake('public');
        $user = User::first();
        $item = PortfolioItem::first();

        $file = UploadedFile::fake()->image('nova_foto.jpg', 800, 600);

        $response = $this->actingAs($user)
            ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
            ->put(route('admin.portfolio.update', $item->id), [
                'title' => 'Foto Atualizada',
                'category' => 'Instalações',
                'description' => 'Nova descrição',
                'image' => $file,
            ]);

        $response->assertRedirect(route('admin.portfolio.index'));
        $item->refresh();
        $this->assertEquals('Foto Atualizada', $item->title);
        $this->assertStringStartsWith('portfolio/', $item->image);
        Storage::disk('public')->assertExists($item->image);
    }

    public function test_update_with_image_exceeding_max_rule_fails_validation(): void
    {
        Storage::fake('public');
        $user = User::first();
        $item = PortfolioItem::first();

        // 25MB image (exceeds max:20480)
        $file = UploadedFile::fake()->create('foto_grande.jpg', 25600, 'image/jpeg');

        $response = $this->actingAs($user)
            ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
            ->from(route('admin.portfolio.edit', $item->id))
            ->put(route('admin.portfolio.update', $item->id), [
                'title' => 'Foto Grande',
                'category' => 'Instalações',
                'image' => $file,
            ]);

        $response->assertRedirect(route('admin.portfolio.edit', $item->id));
        $response->assertSessionHasErrors('image');
    }

    public function test_update_with_failed_upload_due_to_php_limit(): void
    {
        Storage::fake('public');
        $user = User::first();
        $item = PortfolioItem::first();

        // Simulate UPLOAD_ERR_INI_SIZE (error code 1)
        $file = new UploadedFile(
            sys_get_temp_dir() . '/test.jpg',
            'test.jpg',
            'image/jpeg',
            UPLOAD_ERR_INI_SIZE,
            true
        );

        $response = $this->actingAs($user)
            ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
            ->from(route('admin.portfolio.edit', $item->id))
            ->put(route('admin.portfolio.update', $item->id), [
                'title' => 'Foto Erro Upload',
                'category' => 'Instalações',
                'image' => $file,
            ]);

        $response->assertRedirect(route('admin.portfolio.edit', $item->id));
        $response->assertSessionHasErrors('image');
    }
}
