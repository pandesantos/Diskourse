@extends('templates.default')

@section('content')
<div class="row">
	<div class="col-lg-5">
	<h3>Update profile</h3><hr/>
		<form class="form-vertical" role="form" method="post" action="{{ route('profile.edit')}}">
			<div class="form-group{{ $errors->has('first_name') ? ' has-error' : ''}}">
				<label for="first_name" class="control-label">Firstname</label>
				<input type="text" name="first_name" class="form-control" id="first_name" value="{{ Auth::user()->first_name ?: Request::old('first_name') }}">
			@if($errors->has('first_name'))
				<span class="help-block">{{ $errors->first('first_name')}}</span>
			@endif
			</div>
			
			<div class="form-group{{ $errors->has('last_name') ? ' has-error' : ''}}">
				<label for="last_name" class="control-label">Lastname</label>
				<input type="text" name="last_name" class="form-control" id="last_name" value="{{ Auth::user()->last_name ?: Request::old('last_name') }}" >
			@if($errors->has('last_name'))
				<span class="help-block">{{ $errors->first('last_name')}}</span>
			@endif
			</div>


			<div class="form-group{{ $errors->has('location') ? ' has-error' : ''}}">
				<label for="location" class="control-label">Location</label>
				<input type="text" name="location" class="form-control" id="location" value="{{ Auth::user()->location ?: Request::old('location') }}" >
			@if($errors->has('location'))
				<span class="help-block">{{ $errors->first('location')}}</span>
			@endif
			</div>
			
			<div class="form-gorup">
				<button type="submit" class="btn btn-block btn-primary">Update</button>
			</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</div>
</div>
@stop