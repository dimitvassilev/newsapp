<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = factory(\App\User::class)->create([
            'email' => 'user1@mail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123')]);
        $user2 = factory(\App\User::class)->create([
            'email' => 'user2@mail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123')]);
        factory(\App\Models\Article::class, 8)->make()->each(function ($article) use ($user1){
            $article->user_id = $user1->id;
            $article->save();
        });
        sleep(5);
        factory(\App\Models\Article::class, 4)->make()->each(function ($article) use ($user2){
            $article->user_id = $user2->id;
            $article->save();
        });
    }
}
