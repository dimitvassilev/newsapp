<?php

namespace App\Services;

use App\Repositories\ArticleRepositoryInterface;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class PdfDownloader implements PdfDownloaderInterface
{
    protected $downloader;
    protected $repository;

    public function __construct()
    {
        $this->repository = app(ArticleRepositoryInterface::class);//instantiate from IoC container
        $this->downloader = new Mpdf();
    }

    public function download($articleId)
    {
        $article = $this->repository->find($articleId);

        $this->downloader->WriteHTML(view('articlePDF', ['article' => $article]));
        $this->downloader->Output('article'.$articleId, Destination::DOWNLOAD);
    }
}