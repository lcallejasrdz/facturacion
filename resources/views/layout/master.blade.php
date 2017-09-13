<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/images/favicon.ico') }}" />

	    <title>
	    	R-Net Systems | @yield('title')
	    </title>

	    <!-- Bootstrap Core CSS -->
	    {{ Html::style('sbadmin/css/bootstrap.min.css') }}

	    <!-- Custom CSS -->
	    {{ Html::style('sbadmin/css/sb-admin.css') }}

	    <!-- Morris Charts CSS -->
	    {{ Html::style('sbadmin/css/plugins/morris.css') }}

	    <!-- Custom Fonts -->
	    {{ Html::style('sbadmin/font-awesome/css/font-awesome.min.css') }}

	    {{ Html::style('assets/css/template.css') }}
    	{{ Html::style('assets/css/custom.css') }}

	    @yield('styles')

        {{-- <script>
            var direction = 'http://{{ $_SERVER['HTTP_HOST'] }}';
        </script> --}}
        <script>
            var direction = '{{ env('APP_URL') }}';
        </script>
	</head>

	<body>
	    <div id="wrapper">
	        <!-- Navigation -->
	        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	            <!-- Brand and toggle get grouped for better mobile display -->
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand text-center" href="{{ URL::to('dashboard') }}">
	                	<img src="{{ URL::to('assets/images/logo.png') }}" alt="">
	                </a>
	            </div>
	            <!-- Top Menu Items -->
	            <ul class="nav navbar-right top-nav">
	                @include('layout.menus.top')
	            </ul>
	            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
	            <div class="collapse navbar-collapse navbar-ex1-collapse">
	                <ul class="nav navbar-nav side-nav">
	                    @include('layout.menus.principal')
	                </ul>
	            </div>
	            <!-- /.navbar-collapse -->
	        </nav>

	        <div id="page-wrapper">
	            <div class="container-fluid">
				    <div class="row">
				        <div class="col-lg-12">
							@include('alerts.ajax')
							@include('alerts.errors')
							@include('alerts.error')
							@include('alerts.success')
						</div>
					</div>
	                @yield('content')
	            </div>
	            <!-- /.container-fluid -->
	        </div>
	        <!-- /#page-wrapper -->
	    </div>
	    <!-- /#wrapper -->

	    <!-- jQuery -->
	    {{ Html::script('sbadmin/js/jquery.js') }}

	    <!-- Bootstrap Core JavaScript -->
	    {{ Html::script('sbadmin/js/bootstrap.min.js') }}

	    @yield('scripts')

	    <!-- Morris Charts JavaScript -->
	    {{ Html::script('sbadmin/js/plugins/morris/raphael.min.js') }}
	    {{ Html::script('sbadmin/js/plugins/morris/morris.min.js') }}
	    {{ Html::script('sbadmin/js/plugins/morris/morris-data.js') }}
	</body>
</html>
