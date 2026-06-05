
<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('orders:update-statuses')->everyMinute();