<?php

namespace Tests\Unit;

use App\Events\ArticleDeleted;
use App\Models\Article;
use App\Models\Photo;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\PhotoRepository;
use App\Repositories\PhotoRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticlesRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $user1;
    protected $user2;
    protected $repository;

    public function setUp():void
    {
        parent::setUp();
        $this->repository = app()->make(ArticleRepository::class);
        $this->user1 = $user1 = factory(\App\User::class)->create([
            'email' => 'test_user1@mail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123')]);
        $this->user2 = $user2 = factory(\App\User::class)->create([
            'email' => 'test_user2@mail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123')]);

        factory(\App\Models\Article::class)->create(['user_id' => $user1->id]);
        factory(\App\Models\Article::class)->create(['user_id' => $user1->id]);
        factory(\App\Models\Article::class, 4)->make()->each(function ($article) use ($user2){
            $article->user_id = $user2->id;
            $article->save();
        });
    }

    public function tearDown():void
    {
        parent::tearDown();
        \Mockery::close();
    }

    /** @test */
    public function implements_article_repository_interface()
    {
        $this->assertTrue($this->repository instanceof ArticleRepositoryInterface);
    }


    /** @test */
    public function can_get_latest_articles()
    {
        //set config to a low number during the test
        $num = 2;
        config(['newsportal.newsstand_articles' => $num]);

        //act
        $articles = $this->repository->latest();

        //assert
        $this->assertEquals($articles->count(), $num);
        $this->assertEquals($articles->first()->id, Article::orderBy('created_at', 'desc')->first()->id);
    }

    /** @test */
    public function can_check_if_article_is_reported_by_a_user()
    {
        $article = Article::first();
        $this->assertTrue($this->repository->isAuthoredBy($article, $this->user1));
    }

    /** @test */
    public function can_add_an_article()
    {
        $data = ['title' => 'my title', 'body' => 'article body'];
        $this->repository->write($data, $this->user1);
        $this->assertDatabaseHas('articles', array_merge($data, ['user_id' => $this->user1->id]));
    }


    /** @test */
    public function can_get_users_articles()
    {
        $articlesFromRepo = $this->repository->authoredBy($this->user1);
        $userArticles = DB::table('articles')
            ->select('id')
            ->where('user_id', $this->user1->id)
            ->orderBy('created_at', 'desc')->get();

        $this->assertEquals($articlesFromRepo->count(), $userArticles->count());
        $this->assertEquals($articlesFromRepo->pluck('id')->all(), $userArticles->pluck('id')->all());
    }


    /** @test */
    public function can_delete_an_article()
    {
        Event::fake();
        $article = Article::first();
        $this->repository->delete($article);
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
        Event::assertDispatched(ArticleDeleted::class, function ($e) use ($article) {
            return $e->article->id === $article->id;
        });
    }


    /** @test */
    public function can_add_a_photo()
    {
        $this->mock(PhotoRepository::class,  function ($mock) {
            $mock->shouldReceive('addPhoto')->once();
        });

        $this->repository = app()->make(ArticleRepository::class);
        $file = UploadedFile::fake()->image('photo1.jpg');
        $this->repository->addPhoto(1, $file, ['caption' => 'some caption']);
    }
}
