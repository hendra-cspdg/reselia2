<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','photo','model','price'];

    protected $appends = ['photo_path'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($model){
            //remove relations to category
            $model->categories()->detach();

            //remove relations to cart
            $model->carts()->delete();
        });
    }

    public function categories()
    {
    	return $this->belongsToMany('App\Category');
    }

    public function getCategoryListsAttribute()
    {
        if ($this->categories()->count() < 1) {
            return null;
        }
        return $this->categories->lists('id')->all();
    }

    public function getPhotoPathAttribute()
    {
        if ($this->photo !== '') {
            return url('/img/'.$this->photo);
        } else {
            return 'http:://placehold.it/850x618';
        }
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }
}
