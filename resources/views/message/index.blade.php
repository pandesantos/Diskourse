@extends('templates.default')
@section('content')

<h3> Messages Thread</h3>

<div class="row">
    <div class="col-lg-6">
        <form role="form" action="{{ route('message.post') }}" method="post">
            <div class="form-group{{ $errors->has('message') ? ' has-error' : ' ' }}">
                <textarea placeholder="Create a thread, {{ Auth::user()->getFirstNameOrUsername() }}." name="message" class="form-control" rows="2"></textarea>
                @if($errors->has('message'))
                <span class="help-block">{{ $errors->first('message') }}</span>
                @endif
            </div>

            <input type="checkbox" name="friends" value="car"> Anusha
            <input type="checkbox" name="friends" value="Car" checked> Akash
            <input type="checkbox" name="friends" value="Car" checked> Pramod
            <input type="checkbox" name="friends" value="Car" checked> Prajwol
            <input type="checkbox" name="friends" value="Car" checked> Nischal
            <input type="checkbox" name="friends" value="Car" checked> Santosh<br>

            <button type="submit" class="btn btn-success">Send</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}" >
        </form>
        <hr>
    </div>


  



</div>
 
<div class="row">
    <div class="col-lg-5">
        @if(!$messages->count())
        <p> No message threads yet. </p>
        @else
        @foreach($messages as $message)
        <div class="media">
    <a class="pull-left" href="{{ route('profile.index', [ 'username'=>$message->user->username]) }}">
        <img class="media-object" alt="{{ $message->user->getNameOrUsername() }}" src="{{ $message->user->getAvatarUrl() }}">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{ route('profile.index', [ 'username'=>$message->user->username]) }}">{{ $message->user->getNameOrUsername() }}</a></h4>
        <p>{{ $message->body}}</p>
        <ul class="list-inline">
            <li>{{ $message->created_at->diffForHumans() }}</li>
            
        </ul>



        @foreach($message->replies as $reply)
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" alt="{{ $reply->user->getNameOrUsername() }}" src="{{ $reply->user->getAvatarUrl() }}">
            </a>
            <div class="media-body">
                <h5 class="media-heading"><a href="{{ route('profile.index', ['username'=>$reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
                <p>{{ $reply->body }}</p>
                <ul class="list-inline">
                    <li>{{ $reply->created_at->diffForHumans() }}</li>
                </ul>
            </div>
        </div>
        @endforeach


 
 
        <form role="form" action="{{ route('message.reply', ['messageId'=>$message->id]) }}" method="post">
            <div class="form-group {{ $errors->has("reply-{$message->id}") ? ' has-error': '' }}">
                <textarea name="reply-{{$message->id}}" class="form-control" rows="2" placeholder="Reply"></textarea>
                @if($errors->has("reply-{$message->id}"))
                <span class="help-block">{{$errors->first("reply-{$message->id}") }}</span>
                @endif()
            </div>
            <input type="submit" value="Reply" class="btn btn-default btn-sm">
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
</div>


        @endforeach
        {!! $messages->render() !!}
        @endif
        
            </div>
        </div>
 
        
<!--
<style>.embed-container { 
	position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 67%; } 
	.embed-container iframe, .embed-container object, .embed-container embed { 
		position: absolute; top: 0; left: 0; width: 100%; height: 65%; }
	</style>
	<div class='embed-container'>
	<iframe src='http://www.youtube.com/embed/QILiHiTD3uc' frameborder='0' allowfullscreen></iframe></div> -->

@stop