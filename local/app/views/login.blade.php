<div class="login-body text-center">
	{{ Form::open(array('url' => 'login')) }}
	<!-- if there are login errors, show them here -->
	<div class="row">
	    {{ $errors->first('email') }}
	    {{ $errors->first('password') }}
	</div>

	<div class="row">
	    <div class="col-md-12">
	   		{{ Form::text('email', Input::old('email'), array('placeholder' => 'Email address', 'class' => 'form-control')) }}
	    </div>
	</div>

	<div class="row">
	    <div class="col-md-12">
	    	{{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
		</div>
	</div>

	<div class="row">
	    <div class="col-md-12">
			{{ Form::submit('Zaloguj', array('class' => 'btn btn-block btn-primary')) }}
		</div>
	</div>
	{{ Form::close() }}
</div>