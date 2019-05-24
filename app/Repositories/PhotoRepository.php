<?php

namespace App\Repositories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;

class PhotoRepository extends EloquentRepository implements PhotoRepositoryInterface
{
    const STORAGE_PATH = 'img';

    /** @var StorageInterface */
    protected $storage;

    /** @var string */
    protected $modelClass = Photo::class;

    protected $validationRules = [
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'caption' => 'string|max:128|nullable'
    ];


    public function __construct()
    {
        parent::__construct();
        $this->storage = app()->make(StorageInterface::class);
    }


    /**
     * @param $id
     * @param $file
     * @param $data
     * @return Model
     * A photo model
     */
    public function addPhoto($id, $file, $data)
    {
        $this->validate(array_merge(['photo' => $file], $data));

        $photoName = $this->storage->disk('public')->putFile(self::STORAGE_PATH, $file);

        //create a new photo model record with the generated name
        $photo = $this->makePhoto([
            'caption' => $data['caption'],
            'path'  => '/storage/'.$photoName,
        ]);

        $photo->article_id = $id;
        $photo->save();
        return $photo;
    }

    protected function makePhoto($data)
    {
        $photo = app()->make($this->modelClass);
        $photo->fill($data);
        return $photo;
    }

}