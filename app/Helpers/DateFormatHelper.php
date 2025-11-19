<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateFormatHelper
{
    /**
     * Format the date to 'Last Updated on: 30 Dec 2025, 6:00 PM'
     *
     * @param string $date
     * @return string
     */
    public static function formatDate($date)
    {
        // Use Carbon to parse the date and format it
        return Carbon::parse($date)->format('d M Y, g:i A');
    }
}
