<!DOCTYPE html>
<html>
<head>
    <title>Inventory - APP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="{{asset('front_assets/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('front_assets/css/bootstrap.css')}}" rel="stylesheet">   
    <link href="{{asset('front_assets/css/jquery.smartmenus.bootstrap.css')}}" rel="stylesheet">    
    <link href="{{asset('front_assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('front_assets/css/toastr.min.css')}}" rel="stylesheet">     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{asset('front_assets/js/toastr.min.js')}}"></script> 
    <script src="{{asset('front_assets/js/bootstrap.js')}}"></script> 
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
  
        body{
            margin: 0;
            font-size: 12px;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }
        .navbar-laravel
        {
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
        }
        .navbar-brand , .nav-link, .my-form, .login-form
        {
            font-family: Raleway, sans-serif;
        }
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        
    </style>
</head>
<body>
    
<nav class="navbar navbar-inverse navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Laravel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
                @guest
                    
                @else
                {!! getTopNavCat() !!}
                <ul class="nav navbar-nav">
                    <li class="nav-item" style="font-size:initial">
                        <a class="nav-link" href="{{ route('logout') }}" style="color:#9d9d9d">Logout</a>
                    </li>
                </ul>
                @endguest
            
  
        </div>
    </div>
</nav>
  
@yield('content')
<!-- jQuery library -->
 
  <script type="text/javascript" src="{{asset('front_assets/js/jquery.smartmenus.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/jquery.smartmenus.bootstrap.js')}}"></script>
  <script>
    function isNumber(evt) 
    {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57) && iKeyCode != 9){
        alert("Please Enter Numbers Only");
            return false;
        }
        return true;
    }
  </script>  
</body>
</html>