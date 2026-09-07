<?php

use App\Models\Post;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// -----------------------------------------------------------------------
// IOA Natal: Publish scheduled blog posts (run every minute via cron job)
// Configure Locaweb cron: * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
// -----------------------------------------------------------------------
Schedule::call(function () {
    Post::where('status', 'scheduled')
        ->where('published_at', '<=', now())
        ->update(['status' => 'published']);
})->everyMinute()->name('publish-scheduled-posts')->withoutOverlapping();

// Regenerate sitemap.xml daily
Schedule::command('sitemap:generate')->daily()->name('generate-sitemap');
