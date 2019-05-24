<?php

namespace App\Models;

use App\Models\Interfaces\Authorable;
use App\Models\Traits\HasAuthor;
use App\Repositories\PhotoRepository;
use App\Repositories\PhotoRepositoryInterface;
use App\Services\Summarizers\Summarizing;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model implements Authorable
{
    use HasAuthor;

    protected $fillable = [
        'title',
        'body'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }


    /**
     * @param Summarizing $summarizer
     * @return string
     */
    public function preview(Summarizing $summarizer): string
    {
        return $summarizer->summarize($this->body);
    }

}
