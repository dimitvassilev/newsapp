<?php

namespace App\Repositories;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class Storage implements StorageInterface
{

    public function __call($name, $arguments)
    {
        return \Illuminate\Support\Facades\Storage::{$name}(...$arguments);
    }

    /** @inheritdoc */
    public function drive($name = null)
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function disk($name = null)
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function cloud()
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function createLocalDriver(array $config)
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function createFtpDriver(array $config)
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function createSftpDriver(array $config)
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function createS3Driver(array $config)
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function set($name, $disk)
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function getDefaultDriver()
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function forgetDisk($disk)
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function extend($driver, \Closure $callback)
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function putFile($path, $file, $options = [])
    {
        return static::__call(__FUNCTION__, func_get_args());
    }

    /** @inheritdoc */
    public function putFileAs($path, $file, $name, $options = [])
    {
        return static::__call(__FUNCTION__, func_get_args());
    }
}