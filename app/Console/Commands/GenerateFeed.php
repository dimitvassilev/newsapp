<?php

namespace App\Console\Commands;

use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates updated RSS feed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ArticleRepositoryInterface $repository
     * @return mixed
     */
    public function handle(ArticleRepositoryInterface $repository)
    {
        $this->info("Generating RSS Feed...");

        //fetch latest articles
        $articles = $repository->latest();

        //get current time in RSS-compatible format
        $lastBuildDate = now()->format(\DateTime::RSS);

        //Pass data into the rss.blade.view, out comes text in rss format
        $rssFileContents = view('rss', compact('articles', 'lastBuildDate'));

        // Saves the generated rss feed into a file called rss.xml in the public folder
        Storage::disk('public')->put('rss.xml', $rssFileContents);

        $this->info("RSS Feed Generation Completed.");
    }
}
