<?php

namespace Diskourse\Models;

use Diskourse\Models\Status;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract
                                    
{
    use Authenticatable, Authorizable;

    protected $table = 'users';

    protected $fillable = [
    'username', 
    'email', 
    'password',
    'first_name', 
    'last_name', 
    'location'
    ];

    protected $hidden = [
    'password', 
    'remember_token'

    ];

    public function getName() {

        if($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }
        if($this->first_name) {
            return $this->first_name;
        }

        return null;
    }

    public function getNameOrUsername() {

        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername() {

        return $this->first_name ?: $this->username;
    }

    public function getAvatarUrl() {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=40";
    }

    public function statuses() {
        return $this->hasMany('Diskourse\Models\Status', 'user_id');
    }

    public function messages() {
        return $this->hasMany('Diskourse\Models\Message', 'user_id');
    }

    public function likes() {
        return $this->hasMany('Diskourse\Models\Like', 'user_id');
    }

    public function friendsOfMine() {
        return $this->belongsToMany('Diskourse\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf() {
        return $this->belongsToMany('Diskourse\Models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends() {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get() );
    }

    public function friendRequests() {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending() {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user) {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user) {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user) {
        $this->friendOf()->attach($user->id);
    }

    public function deleteFriend(User $user) {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user) {
        return (bool) $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted'=>true,
            ]);
    }

    public function isFriendsWith(User $user) {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    /**public function likes() {
        return $this->morphMany('Diskourse\Models\Like', 'likeable');
    } **/

    public function hasLikedStatus(Status $status) {
        return (bool) $status->likes->where('user_id', $this->id)->count();
    }


}
