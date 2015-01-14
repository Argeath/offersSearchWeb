<div class="login-body">
	{{ Form::open(array('url' => 'login')) }}
	<h1>Login</h1>

	<!-- if there are login errors, show them here -->
	<div class="row">
	    {{ $errors->first('email') }}
	    {{ $errors->first('password') }}
	</div>

	<div class="row">
	    <div class="col-md-6">
	    	{{ Form::label('email', 'Email Address') }}
	    </div>
	    <div class="col-md-6">
	   		{{ Form::text('email', Input::old('email'), array('placeholder' => 'awesome@awesome.com')) }}
	    </div>
	</div>

	<div class="row">
	    <div class="col-md-6">
	    	{{ Form::label('password', 'Password') }}
	    </div>
	    <div class="col-md-6">
	    	{{ Form::password('password') }}
		</div>
	</div>

	<div class="row">
	    <div class="col-md-12">
			{{ Form::submit('Submit!', array('class' => 'btn btn-block btn-success')) }}
		</div>
	</div>
	{{ Form::close() }}
</div>