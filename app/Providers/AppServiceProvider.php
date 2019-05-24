<?php

namespace App\Providers;

use App\Repositories\ArticleRepository;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\PhotoRepository;
use App\Repositories\PhotoRepositoryInterface;
use App\Repositories\Storage;
use App\Repositories\StorageInterface;
use App\Services\PdfDownloader;
use App\Services\PdfDownloaderInterface;
use App\Services\Summarizers\NewsStandSummarizer;
use App\Services\Summarizers\RssSummarizer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(PhotoRepositoryInterface::class, PhotoRepository::class);
        $this->app->bind(StorageInterface::class, Storage::class);
        $this->app->bind(PdfDownloaderInterface::class, PdfDownloader::class);
        $this->app->bind(NewsStandSummarizer::class, NewsStandSummarizer::class);
        $this->app->bind(RssSummarizer::class, RssSummarizer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
