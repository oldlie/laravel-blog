<?php
/**
 *
 * php artisan make:model --migration Post
 * php artisan migrate
 *
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $dates = ['published_at'];

    public function setTitleAttribute($value)
    {
        $this->attributes['name'] = $value;
    }
}
