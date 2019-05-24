<?php

namespace App\Repositories;


use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Models\Article;
use App\Models\Interfaces\Authorable;
use App\Models\Interfaces\Fresh;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;

class ArticleRepository extends EloquentRepository implements ArticleRepositoryInterface
{


    protected $modelClass = Article::class;

    /** @var PhotoRepositoryInterface */
    protected $photoRepository;

    protected $validationRules = [
        'title' => 'string|between:3,128',
        'body' => 'string|min:5'
    ];

    /**
     * ArticleRepository constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->photoRepository = app(PhotoRepositoryInterface::class);

        $class = new \ReflectionClass($this->modelClass);
        if(!$class->implementsInterface(Authorable::class))
        {
            throw new \Exception('$modelClass should be an instance of '.Authorable::class);
        }
    }


    /**
     * Get the newest articles in the repository,
     * up to a number according to the configuration
     * @return mixed
     */
    public function latest()
    {
        return Article::orderBy('created_at', 'desc')//sort latest first
            ->with('photos')//eager load nested photos
            ->take(config('newsportal.newsstand_articles', 10))//limit to the configured number
            ->get();
    }


    /**
     * Checks if an article with the specified id
     * has been created by certain user
     * @param int|Authorable $article
     * @param $user
     * @return bool
     */
    public function isAuthoredBy($article, $user): bool
    {
        if($article instanceof $this->modelClass)
        {
            return $article->isAuthoredBy($user);
        }
        return $this->has($article) && $this->find($article)->isAuthoredBy($user);
    }


    /**
     * Create an article with the specified author.
     * @param array $data
     * @param $user
     */
    public function write(array $data, $user)
    {
        $this->validate($data);

        $model = new $this->modelClass;
        $model->fill($data);
        $model->assignAuthor($user);
        $model->save();
        event(new ArticleCreated($model));
    }


    /**
     * Get the articles whose author is the specified user,
     * optionally specifying page number for paginated result.
     * @param $user
     * @param null $page
     * @return mixed
     */
    public function authoredBy($user, $page = null)
    {
        return $this->modelClass::authoredBy($user)
            ->orderBy('created_at', 'desc')//sort latest first
            ->with('photos')//eager load nested photos
            ->paginate(config('newsportal.user_articles', 20), $columns = ['*'], 'page', $page)
            ->withPath("users/{$user->id}/articles");//pagination config
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model|int $model
     * @return mixed
     * @throws \Exception
     */
    public function delete($model)
    {
        $model = $this->normalizeModel($model);
        $deleted = parent::delete($model);
        event(new ArticleDeleted($model));
        return $deleted;
    }


    /**
     * @param $id
     * Article ID
     *
     * @param $file
     * The photo file
     *
     * @param $data
     * Photo model attributes
     *
     * @return Model
     * The photo model
     */
    public function addPhoto($id, $file, $data)
    {
        return $this->photoRepository->addPhoto($id, $file, $data);
    }
}