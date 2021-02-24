<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Nitya Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 3.3.2 -->     
    <link rel="stylesheet" href="/admin/css/bootstrap.min.css">  
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <!-- <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" /> -->    
    <!-- Theme style -->
    <link href="/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/admin.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
   
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    @toastr_css
  </head>
  <body class="skin-blue">
    <div class="wrapper">

      @include('admin.includes.navbar')
      @include('admin.includes.sidebar')  
      @yield('admin-content')
      @include('admin.includes.footer')
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    
    <script src="/js/jquery.min.js"></script>
    <script src="/admin/js/app.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js"></script>   
    <!-- <script src="/js/bootstrap.min.js.map"></script> -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    	$(document).ready( function () {
    		$('#myTable').DataTable();
    	} );
    </script>
  </body>
   @toastr_js
   @toastr_render
</html>