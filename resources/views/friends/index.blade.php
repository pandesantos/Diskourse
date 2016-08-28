@extends('templates.default')

@section('content')

<div class="row">
                <div class="col-lg-6">
                        <h3>Your List</h3>
 
        @if(!$friends->count())

        <p>You have no one in the list.</p>

        @else

        @foreach($friends as $user)
        @include('user/partials/userblock')
        @endforeach

        @endif
                </div>
                <div class="col-lg-6">
                        <h4>New followers</h4>
 
                        @if(!$requests->count())
                        <p>You have no new followers.</p>

                        @else
                        @foreach($requests as $user)
                        @include('user.partials.userblock')
                        @endforeach

                        @endif

                </div>
         </div>

@stop