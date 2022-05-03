<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nice Apartment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="singin.css">
    <link rel="stylesheet" href="style.css">
    <!-- Popper JS -->
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    </script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <script>
      window.onload = function() {
        SetTimeHeader();
      }
    </script>
    <style>
        footer{
    width: 100%;
    height: 56px;
    background-color: rgb(50,144,119);
    text-align: center;
    line-height: 56px;
    color: white;
    font-size: 15px;
    font-weight: 600;
    margin-top: 10px;
}

footer span{
    margin-left: 10px;
}
.header{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: rgb(50,144,119);
    color: white;
    min-height: 55px;
}
.header--logo{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 20px;

}

.header--logo__icon{
    color: rgb(11, 52, 41);
    font-size: 25px;
    font-weight: 600;
}
.header--logo__image{

}
.header--logo__text{
    font-size: 20px;
    font-weight: 700;
    margin-left: 15px;
}
.header--time{
    display: flex;
    right: 30%;
    transform: translateX(-50%);

}
.header--close{
    display: flex;
    font-size: 20px;
    font-weight: 700;
    justify-content: space-between;
    align-items: center;
    margin-right: 40px;
}

.header--close i{
  padding: 0 8px;
  color:white;
}
.big-close{
    font-size: 50px;
}

.header--time--hour{
margin-right: 12px;
}

.dropdown-toggle::after{
    color:white;
}

.line{
    margin-top: 20px;
}

.container{
    height: 460px;
}
    </style>

</head>
<body>
<div class="header">
  <div class="header--logo">
    <div class="header--logo__icon">
    <i class="fas fa-building"></i>
    </div>
    <div class="header--logo__text">NICE APARTMENT</div>
  </div>
  <div class="header--time">
  </div>
  <div class="header--close">
  @can('authenticated')
    <div class="user__img--container">
      <img src="{{Auth::user()->Avatar}}" alt="" class="user--img">
    </div>
  @endcan
      <div class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa-solid fa-square-caret-down"></i></a>
          <ul class="dropdown-menu">
            @cannot('authenticated')
            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
            <li><a href="{{ route('register') }}">Đăng ký</a></li>
            @endcannot

            @can('authenticated')
            <li>
            <div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Đăng xuất') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            </a></li>
            @endcan
          </ul>
      </div>
  </div>
</div>


<div class="line"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
<footer>
<i class="fa-brands fa-envira"></i>
<i class="fa-solid fa-leaf"></i>
  <span class="footer--text">NICE APARTMENT</span>
</footer>
</body>
</html>


