<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'content', 'slug', 'image', 'category_id', 'user_id', 'cover'];

    public function getFormattedDate($column, $format = 'd-m-Y H:i:s')
    {
        return Carbon::create($this->$column)->format($format);
    }


    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /* public function user()
    {
        return $this->belongsTo('App\User');
    } */


    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    //Un post può avere più tag
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
