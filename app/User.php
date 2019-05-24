<?php

namespace App;

use App\Models\Article;
use App\Notifications\VerifyEmailDatabaseStub;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as VerifiesMail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Interfaces\MustBeActivated as Activatable;
use App\Models\Traits\MustBeActivated;
use Illuminate\Auth\MustVerifyEmail;

class User extends Authenticatable implements Activatable, VerifiesMail
{
    use Notifiable;
    use MustVerifyEmail;
    use MustBeActivated;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the articles created by the user.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }


    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailDatabaseStub());
    }
}
