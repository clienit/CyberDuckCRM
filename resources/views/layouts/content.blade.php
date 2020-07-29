<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-12">
            		<h1 class="m-0 text-dark"></h1>
          		</div><!-- /.col -->
        	</div><!-- /.row -->
      	</div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      	<div class="container-fluid">
        	<div class="row">
	          	<div class="col-lg-12">

		            @if ($message = Session::get('success'))
		                <div class="alert alert-success">
		                    <p>{{ $message }}</p>
		                </div>
		            @endif

		            @if ($errors->any())
			            @foreach ($errors->all() as $error)
						    <div class="alert alert-danger">
			                    <p>{{ $error }}</p>
			                </div>
						@endforeach
					@endif

		            <!-- Contains page content -->
		  			@yield('content')

	  			</div>
	        </div>
	        <!-- /.row -->
      	</div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->  