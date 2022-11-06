<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * Trait UuidTrait
 * @package App\Traits
 */
trait UuidTrait
{
    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->keyType      = 'string';
                $model->incrementing = false;

                $model->{$model->getKeyName()} = (string)Str::orderedUuid();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
