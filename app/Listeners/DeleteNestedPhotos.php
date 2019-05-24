<?php

namespace App\Listeners;

use App\Models\Photo;
use Illuminate\Support\Facades\File;

class DeleteNestedPhotos
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $query = Photo::where('article_id', $event->article->id);
        $files = $query->select('path')->get();
        $files->transform(function ($item, $key) {
            return public_path(substr($item->path, 1));
        });
//        dd($files->all());
        $query->delete();
        File::delete($files->all());
    }
}
