@extends('templates.default')

@section('content')

        <div class="col-md-5 col-md-offset-3 v-cent">
            <form method="POST" enctype="multipart/form-data">
                <h3>Upload File</h3>
                <hr/>
                <div class="form-group{{ $errors->has('faculty') ? ' has-error' : ''}}">
                    <label for="inputText">Faculty</label>
                    <input type="text" class="form-control" id="inputText" placeholder="Eg: Computer Engineering" name="faculty">

                @if($errors->has('faculty'))
					<span class="help-block">{{ $errors->first('faculty')}}</span>
				@endif

                </div>

                <div class="form-group {{ $errors->has('subject') ? ' has-error' : ''}}">
                    <label for="inputText">Subject</label>
                    <input type="text" class="form-control" id="text" placeholder="Eg: Operating System" name="subject">

                @if($errors->has('subject'))
					<span class="help-block">{{ $errors->first('subject')}}</span>
				@endif
                </div>

                <div class="form-group{{ $errors->has('fileupload') ? ' has-error' : ''}}">
                <span class="btn btn-default btn-file">Choose file<input type="file" name="fileupload">
                </span>
                </div>

                <button type="submit" class="btn btn-block btn-primary" name="submit">Submit</button>
  				<input type="hidden" name="_token" value="{{ Session::token() }}">
                           
            </form>
        </div>
    </div>
</script>
@stop