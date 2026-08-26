<?php

if (! function_exists('sectionHeading')) {
    function sectionHeading(?string $heading): string
    {
        if (empty($heading)) {
            return '';
        }

        $words = preg_split('/\s+/', trim($heading));

        if (count($words) < 2) {
            return e($heading);
        }

        $accent = array_pop($words);
        $normal = implode(' ', $words);

        return e($normal) . ' <span class="accent">' . e($accent) . '</span>';
    }
}
