<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('report:daily-sales')->dailyAt('20:00');// Schedules the daily sales report command to run at 8:00 PM daily
// Schedule::command('report:daily-sales')->everyMinute();
// Alternative timings:
// ->daily(); // Runs at midnight
// ->dailyAt('18:00'); // Runs at 6:00 PM
