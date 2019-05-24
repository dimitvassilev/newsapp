<?php

namespace App\Services\Summarizers;


class RssSummarizer implements Summarizing
{
    /**
     * Generate a summary of the given text
     * @param string $text
     * @return string
     */
    public function summarize(string $text): string
    {
        return substr($text, 0, 50).'...';
    }
}