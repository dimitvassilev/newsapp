<?php

namespace App\Models\Traits;


use Illuminate\Database\Eloquent\Builder;

trait TakesLatest
{

    /**
     * Scope a query to only articles of certain user
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatest($query): Builder
    {
        return $query->orderBy('created_at', 'desc')
            ->take(config('newsportal.newsstand_articles', 10));
    }
}