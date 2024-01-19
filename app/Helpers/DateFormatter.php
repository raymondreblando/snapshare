<?php

namespace App\Helpers;
use Illuminate\Support\Number;

class DateFormatter
{
    public static function formatElapseTime(string $dateCreated): string
    {
        $now = now();
        $difference = $now->diffInSeconds($dateCreated);

        if ($difference < 60) {
            return $difference . ' seconds ago';
        } elseif ($difference < 3600) {
            $minutes = floor($difference / 60);
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
        } elseif ($difference < 86400) {
            $hours = floor($difference / 3600);
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        } else {
            $days = floor($difference / 86400);
            return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
        }
    }
}