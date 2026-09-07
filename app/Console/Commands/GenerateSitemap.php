<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Post;
use App\Models\PortfolioItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;

class GenerateSitemap extends Command
{
    protected $signature   = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml for IOA Natal website';

    public function handle(): int
    {
        $this->info('Generating sitemap.xml ...');

        $baseUrl = config('app.url');
        $lines   = [];
        $lines[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $lines[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Static pages
        $staticPages = [
            ['url' => '/',          'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => '/sobre',     'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/cursos',    'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => '/turmas',    'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => '/portfolio', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/blog',      'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => '/contato',   'priority' => '0.6', 'changefreq' => 'monthly'],
        ];

        foreach ($staticPages as $page) {
            $lines[] = '  <url>';
            $lines[] = "    <loc>{$baseUrl}{$page['url']}</loc>";
            $lines[] = '    <lastmod>' . now()->toAtomString() . '</lastmod>';
            $lines[] = "    <changefreq>{$page['changefreq']}</changefreq>";
            $lines[] = "    <priority>{$page['priority']}</priority>";
            $lines[] = '  </url>';
        }

        // Dynamic courses
        Course::where('is_active', true)->each(function (Course $course) use ($baseUrl, &$lines) {
            $lines[] = '  <url>';
            $lines[] = "    <loc>{$baseUrl}/cursos/{$course->slug}</loc>";
            $lines[] = '    <lastmod>' . $course->updated_at->toAtomString() . '</lastmod>';
            $lines[] = '    <changefreq>weekly</changefreq>';
            $lines[] = '    <priority>0.8</priority>';
            $lines[] = '  </url>';
        });

        // Dynamic blog posts
        Post::published()->each(function (Post $post) use ($baseUrl, &$lines) {
            $lines[] = '  <url>';
            $lines[] = "    <loc>{$baseUrl}/blog/{$post->slug}</loc>";
            $lines[] = '    <lastmod>' . $post->updated_at->toAtomString() . '</lastmod>';
            $lines[] = '    <changefreq>monthly</changefreq>';
            $lines[] = '    <priority>0.6</priority>';
            $lines[] = '  </url>';
        });

        $lines[] = '</urlset>';

        $xml  = implode("\n", $lines);
        $path = public_path('sitemap.xml');
        file_put_contents($path, $xml);

        $this->info("✓ sitemap.xml saved to: {$path}");

        return Command::SUCCESS;
    }
}
