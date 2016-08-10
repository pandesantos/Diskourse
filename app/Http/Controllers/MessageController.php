<?php

namespace Diskourse\Http\Controllers;

use Auth;
use Diskourse\Models\User;
use Illuminate\Http\Request;
use Diskourse\Models\Message;

class MessageController extends Controller {

	public function getMessage() {

		$messages= Message::notReply()->where(function($query) {
				return $query->where('user_id', Auth::user()->id)
				->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
			})
			->orderBy('created_at', 'desc')
			->paginate(10);

			
		return view('message.index')
		->with('messages', $messages);
	}

	public function postMessage(Request $request) {
		$this->validate($request, [
			'message'=>'required|max:1000',
			]);

		Auth::user()->messages()->create([
			'body'=>$request->input('message'),
			]);

		return redirect()
		->route('message.post')
		->with('info', 'Message sent.');
	}

	public function postReply(Request $request, $messageId) {

		$this->validate($request, [
			"reply-{$messageId}"=>'required|max:1000',
			], [
			'required'=>'The reply body is required.'
			]);

		$message=Message::notReply()->find($messageId);

		if(!$message) {
			return redirect()->route('home');
		}

		if(!Auth::user()->isFriendsWith($message->user) && Auth::user()->id !==$message->user->id) {
			return redirect()->route('home');
		}

		$reply=Message::create([
			'body'=>$request->input("reply-{$messageId}"),
			])->user()->associate(Auth::user());

		$message->replies()->save($reply);

		return redirect()->back();
	}


}


?>