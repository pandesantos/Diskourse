<?php

namespace Diskourse\Http\Controllers;

use Auth;
use Diskourse\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller {
	public function getIndex() {
		$friends=Auth::user()->friends();
		$requests=Auth::user()->friendRequests();

		return view('friends.index')
		->with('friends', $friends)
		->with('requests', $requests);

	}

	public function getAdd($username){
		$user= User::where('username', $username)->first();

		if(!$user) {
			return redirect()
			->route('home')
			->with('info', 'That user could not be found');
		}

		if(Auth::user()->id===$user->id) {
			return redirect()
			->route('home')
			->with('info', 'Cheeky! But you cannot add yourself. ;)');
		}

		if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
			return redirect()
			->route('profile.index', ['username'=>$user->username])
			->with('info', 'Request already pending.');
		}

		if(Auth::user()->isFriendsWith($user)) {
			return redirect()
			->route('profile.index', ['username'=>$user->username])
			->with('info', 'Already in the list.');
		}

		Auth::user()->addFriend($user);
		return redirect()
		->route('profile.index', ['username'=>$username])
		->with('info', 'Following');
	}

	public function getAccept($username){
		$user= User::where('username', $username)->first();

		if(!$user) {
			return redirect()
			->route('home')
			->with('info', 'That user could not be found');
		}


		if(!Auth::user()->hasFriendRequestReceived($user)) {
			return redirect()->route('home');
		}

		Auth::user()->acceptFriendRequest($user);

		return redirect()
		->route('profile.index', ['username'=>$username])
		->with('info', 'Added to your list. You\'re following each other. ');
	}

	public function postDelete($username) {
		$user=User::where('username', $username)->first();

		if(!Auth::user()->isFriendsWith($user)) {
			return redirect();
		}
		
		Auth::user()->deleteFriend($user);
		return redirect()->back()->with('info', 'Removed from the list');
	}
}