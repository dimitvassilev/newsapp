<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    use MakesVerifications;

    /**
     * @var ArticleRepositoryInterface $repository
     */
    protected $repository;

    /**
     * ArticlesController constructor.
     * @param ArticleRepositoryInterface $repository
     */
    public function __construct(ArticleRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth');
        $this->middleware('active');
        $this->middleware('throttle:60,1');
    }

    /**
     * Display the upload form
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function showForm(Request $request)
    {
        return view('uploader', ['id' => $request->route('id')]);
    }


    /**
     * Upload photo.
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function upload(Request $request)
    {
        $this->verifyOwnership($request);
        $this->verifyExistence($request);

        $photo = $this->repository->addPhoto(
            $request->route('id'),
            $request->file('photo'),
            ['caption' => $request->caption]);

        return back()
            ->with('success', 'The photo has been successfully uploaded.')
            ->with('photo', basename($photo->path));
    }
}
