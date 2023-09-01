<?php
namespace App\Traits;

trait PositionTrait
{
    public static function bootPositionTrait()
    {
        static::addGlobalScope('position', function ($builder) {
            $builder->orderBy('position', 'asc');
        });
    }
}
