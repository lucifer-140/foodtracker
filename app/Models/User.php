<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function meals(): HasMany
    {
        return $this->hasMany(Meal::class);
    }


    public function friendRequestsFrom()
    {
        return $this->belongsToMany(User::class, 'friendships', 'addressee_id', 'requester_id')
            ->wherePivot('status', 0) // 0 = Pending
            ->withTimestamps();
    }


    public function friendRequestsTo()
    {
        return $this->belongsToMany(User::class, 'friendships', 'requester_id', 'addressee_id')
            ->wherePivot('status', 0) // 0 = Pending
            ->withTimestamps();
    }


    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friendships', 'requester_id', 'addressee_id')
            ->wherePivot('status', 1) // 1 = Accepted
            ->withTimestamps();
    }


    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friendships', 'addressee_id', 'requester_id')
            ->wherePivot('status', 1) // 1 = Accepted
            ->withTimestamps();
    }




    /**
     * An accessor to get all friends for the user.
     * Merges the two friend relationships into a single collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFriendsAttribute()
    {
        if (! array_key_exists('friends', $this->relations)) {
            $this->loadFriends();
        }
        return $this->getRelation('friends');
    }



    protected function loadFriends()
    {
        $friends = $this->friendsOfMine->merge($this->friendOf);
        $this->setRelation('friends', $friends);
    }


    public function getFriendship(User $user)
    {
        return \App\Models\Friendship::where(function ($query) use ($user) {
            $query->where('requester_id', $this->id)->where('addressee_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('requester_id', $user->id)->where('addressee_id', $this->id);
        })->first();
    }
}
