<?php
namespace App\Services;


interface PdfDownloaderInterface
{
    /**
     * @param $articleId
     * @return mixed
     */
    public function download($articleId);
}