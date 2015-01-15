<div class="login-body">
	{{ Form::open(array('url' => 'login')) }}
	<h1>Logowanie</h1>
	<hr>
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
	   		{{ Form::text('email', Input::old('email'), array('placeholder' => 'email', 'class' => 'form-control')) }}
	    </div>
	</div>

	<div class="row">
	    <div class="col-md-6">
	    	{{ Form::label('password', 'Password') }}
	    </div>
	    <div class="col-md-6">
	    	{{ Form::password('password', array('placeholder' => 'password', 'class' => 'form-control')) }}
		</div>
	</div>

	<div class="row">
	    <div class="col-md-12">
			{{ Form::submit('Submit!', array('class' => 'btn btn-block btn-primary')) }}
		</div>
	</div>
	{{ Form::close() }}
</div>