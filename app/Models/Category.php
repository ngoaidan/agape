<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;

class Category extends Model
{
    use Translatable;

    protected $translatable = ['slug', 'name'];

    protected $table = 'categories';

    protected $fillable = ['slug', 'name', 'image'];

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function categories()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }

    public function posts()
    {
        return $this->hasMany(Post::class)
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    public function products(){
        return $this->hasMany(Product::class)->published();

    }
}
