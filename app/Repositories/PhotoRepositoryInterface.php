<?php

namespace App\Repositories;

interface PhotoRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Stores an image file with its attributes
     * @param $id
     * Article's ID
     * @param $file
     * Uploaded image file
     * @param $data
     * Photo attributes
     * @return mixed
     * The saved photo model.
     */
    public function addPhoto($id, $file, $data);
}