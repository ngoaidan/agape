<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Service extends Model
{
    use Translatable;
    use Resizable;

    protected $translatable = ['title', 'body', 'price'];

    const PUBLISHED = 'PUBLISHED';

    protected $guarded = [];

//    public function save(array $options = [])
//    {
//        // If no author has been assigned, assign the current user's id as the author of the post
//        if (!$this->author_id && Auth::user()) {
//            $this->author_id = Auth::user()->getKey();
//        }
//
//        return parent::save();
//    }

    /**
     * Scope a query to only published scopes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('status', '=', static::PUBLISHED);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->belongsTo(Voyager::modelClass('Category'));
    }
}
