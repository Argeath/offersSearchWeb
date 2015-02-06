<!DOCTYPE html>
<html>
<head>
	<title>Baza ofert</title>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Argeath">

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="/assets/stylesheets/sb-admin-2.css">

	<link rel="stylesheet" href="/assets/stylesheets/metisMenu.min.css">
	<script src="/assets/javascript/metisMenu.min.js"></script>

	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script src="http://code.highcharts.com/highcharts.js"></script>

    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">
    <script src="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="//cdn.datatables.net/plug-ins/3cfcc339e89/sorting/numeric-comma.js"></script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/assets/stylesheets/app.css">
    <script src="/assets/javascript/app.js"></script>




	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0" id="menu">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('/') }}">Wyszukiwarka ofert OLX</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-filter"></i>
                </a>
                <ul class="dropdown-menu dropdown-tasks">
                {{ Form::open(array('url' => 'filter')) }}
                    <li>
                        <a href="#">
                            <div>
                                <p class="text-center">
                                    <strong>Filtruj dane</strong>
                                </p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4 no-padding text-center">
                                Rocznik
                            </div>
                            <div class="col-sm-4 no-padding">
                                {{ Form::text('yearFrom', Input::old('yearFrom'), array('placeholder' => 'od', 'class' => 'form-control')) }}
                            </div>
                            <div class="col-sm-4 no-padding">
                                {{ Form::text('yearTo', Input::old('yearTo'), array('placeholder' => 'do', 'class' => 'form-control')) }}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4 no-padding text-center">
                                Przebieg
                            </div>
                            <div class="col-sm-4 no-padding">
                                {{ Form::text('milageFrom', Input::old('milageFrom'), array('placeholder' => 'od', 'class' => 'form-control')) }}
                            </div>
                            <div class="col-sm-4 no-padding">
                                {{ Form::text('milageTo', Input::old('milageTo'), array('placeholder' => 'do', 'class' => 'form-control')) }}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4 no-padding text-center">
                                Moc silnika
                            </div>
                            <div class="col-sm-4 no-padding">
                                {{ Form::text('powerFrom', Input::old('powerFrom'), array('placeholder' => 'od', 'class' => 'form-control')) }}
                            </div>
                            <div class="col-sm-4 no-padding">
                                {{ Form::text('powerTo', Input::old('powerTo'), array('placeholder' => 'do', 'class' => 'form-control')) }}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4 no-padding text-center">
                                Cena
                            </div>
                            <div class="col-sm-4 no-padding">
                                {{ Form::text('priceFrom', Input::old('priceFrom'), array('placeholder' => 'od', 'class' => 'form-control')) }}
                            </div>
                            <div class="col-sm-4 no-padding">
                                {{ Form::text('priceTo', Input::old('priceTo'), array('placeholder' => 'do', 'class' => 'form-control')) }}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4 no-padding text-center">
                                Województwo
                            </div>
                            <div class="col-sm-8 no-padding">
                                {{ Form::select('wojewodztwo', array_merge(['wszystkie'], GeoHelper::$wojewodztwa), 'wszystkie', ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <input type="submit" class="btn btn-block btn-success" value="Filtruj"/>
                    </li>
                {{ Form::close() }}

                </ul>
                <!-- /.dropdown-tasks -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-backward fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-tasks">
                    <li>
                        <a href="#">
                            <div>
                                <p>
                                    <strong>Ostatnio przeglądane</strong>
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                </ul>
                <!-- /.dropdown-tasks -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> Alert
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>Zobacz wszystkie alerty</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Ustawienia</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Wyloguj</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Szukaj...">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="{{ URL::to('/') }}"><i class="fa fa-dashboard fa-fw"></i> Podgląd</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-car fa-fw"></i> Samochody<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                @foreach ($brands as $brand)
                                    <a href="/car/{{ $brand }}">{{ $brand }}</a>
                                @endforeach
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="/offers/newest"><i class="fa fa-bell fa-fw"></i> Najnowsze oferty</a>
                    </li>
                    <li>
                        <a href="/offers/best"><i class="fa fa-star fa-fw"></i> Najciekawsze oferty</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="footer" class="panel">
        © 2015 Dominik Kinal
    </div>

     <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{{ $title }}}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            {{ $main }}
        </div>
    </div>
</div>

<script>
	$(function() {

	    $('#side-menu').metisMenu();

	});
</script>

</body>

</html>