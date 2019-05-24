<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryInterface;
use App\Services\PdfDownloaderInterface;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    use MakesVerifications;


    /**
     * @var ArticleRepositoryInterface $repository
     */
    protected $repository;

    /**
     * @var PdfDownloaderInterface $pdf
     */
    protected $pdf;

    /**
     * ArticlesController constructor.
     * @param ArticleRepositoryInterface $repository
     * @param PdfDownloaderInterface $pdf
     */
    public function __construct(ArticleRepositoryInterface $repository, PdfDownloaderInterface $pdf)
    {
        $this->repository = $repository;
        $this->pdf = $pdf;
        $this->middleware('auth')->except('latest', 'show', 'download');
        $this->middleware('active')->except('latest', 'show', 'download');
        $this->middleware('throttle:60,1');
    }

    /**
     * List lates articles
     *
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        return view('newsstand', ['articles' => $this->repository->latest()]);
    }


    /**
     * Show an article
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->verifyExistence($request);
        $articleId = $request->route('id');
        return view('article', ['article' => $this->repository->find($articleId)]);
    }


    /**
     * Delete an article
     *
     * @param \Illuminate\Http\Request
     * @return void
     */
    public function download(Request $request)
    {
        $this->verifyExistence($request);
        $this->pdf->download($request->route('id'));
    }

    /**
     * Show the articles authored by a user
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function userArticles(Request $request)
    {
        return view('userarticles',
            ['articles' => $this->repository->authoredBy($request->user(), $request->page)]);
    }


    /**
     * Show the from for creating a new article
     *
     * @return \Illuminate\Http\Response
     */
    public function showArticleForm()
    {
        return view('newarticle');
    }


    /**
     * Create a new article
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->repository->write($request->all(), $request->user());

        return redirect(route('articles.user', ['id' => $request->user()]))
            ->with('message', __('The article has been added.'));
    }


    /**
     * Delete an article
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Request $request)
    {
        $this->verifyExistence($request);
        $this->verifyOwnership($request);
        $articleId = $request->route('id');
        $this->repository->delete((int) $articleId);
        return redirect(route('articles.user', ['id' => $request->user()]))
            ->with('message', __('The article has been deleted.'));
    }

}
