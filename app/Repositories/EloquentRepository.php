<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

abstract class EloquentRepository implements BaseRepositoryInterface
{
    /**
     * The class name of the ORM model the repository stores
     * @var string
     */
    protected $modelClass;


    /**
     * EloquentRepository constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $setModel = isset($this->modelClass) && is_subclass_of($this->modelClass, Model::class);
        if(!$setModel){
            throw new \Exception('$modelClass is not properly set up in '.static::class);
        }
    }


    /**
     * Checks if model exists
     * @param $id
     * @return boolean
     */
    public function has($id)
    {
        return $this->modelClass::where('id', $id)->exists();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function find($id)
    {
        return $this->modelClass::find($id);
    }

    /**
     * @param Model $model
     * @return mixed
     */
    public function save($model)
    {
        return $model->save();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $this->validate($data);
        return $this->modelClass::create($data);
    }

    /**
     * @param int|Model $model
     * @return mixed
     * @throws \Exception
     */
    public function delete($model)
    {
        return $this->normalizeModel($model)->delete();
    }

    /**
     * @param $model
     * @return Model|null
     */
    protected function normalizeModel($model)
    {
        return is_int($model) ? $this->find($model): $model;
    }

    /**
     * Validator factory
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $rules)
    {
        return Validator::make($data, $rules);
    }

    /**
     * Validates properties before assigning them to the model,
     * should validation rules have been provided
     * @param array $data
     */
    protected function validate(array $data)
    {
        if(property_exists($this, 'validationRules') && !empty($this->validationRules))
        {
            $this->validator($data, $this->validationRules)->validate();
        }
    }

}