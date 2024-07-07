<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

Schedule::command('command:customer-from-analytic')->everyFifteenMinutes();
Schedule::command('command:tag')->everyFifteenMinutes();
Schedule::command('command:user')->everyFifteenMinutes();
Schedule::command('command:role')->everyFifteenMinutes();
Schedule::command('command:get-username')->everyFifteenMinutes();
Schedule::command('command:customer-pic')->everyFifteenMinutes();
Schedule::command('command:customer-tags')->everyFifteenMinutes();