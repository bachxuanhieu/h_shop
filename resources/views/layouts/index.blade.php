<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> --}}

      <!-- Favicon -->
      <link href="{{asset('frontend/img/favicon.ico')}}" rel="icon">

      <!-- Google Web Fonts -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
  
      <!-- Font Awesome -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  
      <!-- Libraries Stylesheet -->
      <link href="{{asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

      <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
  
      <!-- Customized Bootstrap Stylesheet -->
      <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">

</head>
<body>
    <div id="app">
        @include('layouts.inc.frontend.header')

        @include('layouts.inc.frontend.navbar')

        <main class="py-4">
            @yield('content')
        </main>

        @include('layouts.inc.frontend.foorer')
    </div>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('frontend/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('frontend/mail/contact.js')}}"></script>

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

    <!-- Template Javascript -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script>
        $(document).ready(function () {
        
             $('#sendMessageButton').on('click',function(){
                 var name = $('#name').val();
                 var email = $('#email').val();
                 var message = $('#message').val();
     
                 $.ajax({
                     type:"POST",
                     url: "/SendMessage",
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data: {
                         name: name,
                         email: email,
                         message: message,
                     },
                     success: function (response) {
                         alert('Thư của bạn đã gủi thành công, chúng tôi sẽ gửi mail cho bạn sớm nhất!');
                     }, 
                     error: function (xhr, status, error) {
                         console.error(xhr.responseText);
                         alert('Có lỗi.');
                     }
                     
                 })
     
                 
             })
     
     });
     </script>
    @yield('push_js');
</body>
</html>