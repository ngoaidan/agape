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

    public static function rootCategory($id, $categories, $count = 0){
        $count++;

        foreach ($categories as $category){
            if($category->id == $id){
                if(is_null($category->parent_id)){
                    return $category;
                }
                if($count >= 5)
                    return $category;
                return Category::rootCategory($category->parent_id, $categories, $count);
            }
        }

        return -1;
    }

    public function posts()
    {
        return $this->hasMany(Post::class)
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    public function services()
    {
        return $this->hasMany(Service::class)
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    public function products(){
        return $this->hasMany(Product::class)
            ->published();

    }
}
