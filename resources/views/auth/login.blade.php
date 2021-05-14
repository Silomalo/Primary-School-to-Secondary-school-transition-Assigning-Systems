<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="portal">
    <meta name="generator" content="Hugo 0.79.0">
    <title>PLACEMENT</title>
    
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
  
    <link href="loginMain.css" rel="stylesheet">
  </head>
  <body>
<div class="loginPage">
    <div class="container">

      {{--   @if  (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif --}}
        <x-jet-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="col-md">
                <img src="img/proPic.png" alt="profile">
            </div>

            <div class="col-md">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" :value="old('email')" required autofocus>
            </div>
            <div class="col-md">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required autocomplete="current-password">
            </div>
            {{-- <div class="col-md">
                <input type="checkbox" name="remember"  >
                <label for="remember_me" class="form-label">Remember me</label>
                
            </div> --}}

            <div class="col-md">
                @if (Route::has('password.request'))
                    <input type="submit" value="Log In"  class="btn btn-outline-success">
                    <a href="{{ route('password.request') }}"  style="color:white">Forgot your password?</a> 
                @endif
            </div>
        </div>

    </div>
</div>



<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>

</body>
</html>
 