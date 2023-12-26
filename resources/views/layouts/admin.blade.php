<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
		{{-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> --}}
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('admin/css/adminlte.min.css')}}">
		<link rel="stylesheet" href="{{asset('admin/css/custom.css')}}">
		<link rel="stylesheet" href="{{asset('fontawesome-free-6.4.2-web/css/brands.css')}}">
		<link rel="stylesheet" href="{{asset('fontawesome-free-6.4.2-web/css/fontawesome.css')}}">
		<link rel="stylesheet" href="{{asset('fontawesome-free-6.4.2-web/css/solid.css')}}">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

		<script src="{{asset('tinymce/tinymce.min.js')}}"></script>

		<script>
			tinymce.init({
				selector: '#small_desc', // Chọn phần tử có id là 'myTextarea' để biến đổi thành trình soạn thảo
				plugins: 'advlist autolink lists link image charmap print preview',
				toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				menubar: true, // Tắt thanh menu trên trình soạn thảo
			});
		</script> 

		<script>
			tinymce.init({
				selector: '#desc', // Chọn phần tử có id là 'myTextarea' để biến đổi thành trình soạn thảo
				plugins: 'advlist autolink lists link image charmap print preview',
				toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				menubar: true, // Tắt thanh menu trên trình soạn thảo
			});
		</script>

		<meta name="csrf-token" content="{{csrf_token()}}">
	</head>
	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			@include('layouts.inc.admin.navbar')
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			@include('layouts.inc.admin.slider')
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				@yield('content')
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				
				<strong>Copyright &copy; 2014-2022 AmazingShop All rights reserved.
			</footer>
			
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{asset('admin/js/adminlte.min.js')}}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{asset('admin/js/demo.js')}}"></script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

		@if(Session::has('message'))
				<script>
					var type = "{{ Session::get('alert-type', 'info') }}";
					switch(type){
						case 'info':
							toastr.info("{{ Session::get('message') }}");
							break;
						
						case 'success':
							toastr.success("{{ Session::get('message') }}");
							break;
						
						case 'warning':
							toastr.warning("{{ Session::get('message') }}");
							break;
						
						case 'error':
							toastr.error("{{ Session::get('message') }}");
							break;
					}
				</script>
		@endif
		{{-- <script type="text/javascript">
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script> --}}
		@yield('pushjs')
	</body>
</html>