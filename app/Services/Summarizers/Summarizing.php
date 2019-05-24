<?php

namespace App\Services\Summarizers;


interface Summarizing
{
    /**
     * Generate a summary of the given text
     * @param string $text
     * @return string
     */
    public function summarize(string $text): string;

}