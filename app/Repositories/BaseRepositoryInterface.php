<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function has($id);
    public function find($id);
    public function save($model);
    public function create(array $data);
    public function delete($model);
}