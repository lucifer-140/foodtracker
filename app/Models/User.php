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

    // Defines the relationship for users who have sent a friend request TO this user
    public function friendRequestsFrom()
    {
        return $this->belongsToMany(User::class, 'friendships', 'addressee_id', 'requester_id')
            ->wherePivot('status', 0) // 0 = Pending
            ->withTimestamps();
    }

    // Defines the relationship for users TO WHOM this user has sent a friend request
    public function friendRequestsTo()
    {
        return $this->belongsToMany(User::class, 'friendships', 'requester_id', 'addressee_id')
            ->wherePivot('status', 0) // 0 = Pending
            ->withTimestamps();
    }

    // Defines friends that this user sent a request to (and were accepted)
    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friendships', 'requester_id', 'addressee_id')
            ->wherePivot('status', 1) // 1 = Accepted
            ->withTimestamps();
    }

    // Defines friends that sent a request to this user (and were accepted)
    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friendships', 'addressee_id', 'requester_id')
            ->wherePivot('status', 1) // 1 = Accepted
            ->withTimestamps();
    }


    /**
     * =================================================================
     * CONVENIENCE ACCESSORS & METHODS
     * =================================================================
     */

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

    // The method that actually loads the merged friends collection
    protected function loadFriends()
    {
        $friends = $this->friendsOfMine->merge($this->friendOf);
        $this->setRelation('friends', $friends);
    }

    /**
     * Helper method to get the friendship record between this user and another.
     */
    public function getFriendship(User $user)
    {
        return \App\Models\Friendship::where(function ($query) use ($user) {
            $query->where('requester_id', $this->id)->where('addressee_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('requester_id', $user->id)->where('addressee_id', $this->id);
        })->first();
    }
}
