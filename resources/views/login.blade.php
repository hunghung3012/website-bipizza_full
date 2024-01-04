<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('addUser') }}" method="POST">
                @csrf
                <div class="form ">
                    <h1>Tạo Tài Khoản</h1>
                    @error('name_su')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    <input class="name_input_signup" name="name_su" type="text" placeholder="Họ Và Tên" value="{{old('name_su')}}">
    
    <!-- Hiển thị thông báo lỗi cho trường 'email_su' -->
    @error('email_su')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="email_input_signup" name="email_su" type="text" placeholder="Email" value="{{old('email_su')}}" autocomplete="on">

    <!-- Hiển thị thông báo lỗi cho trường 'password_su' -->
    @error('password_su')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="pass_input_signup" name="password_su" type="password" placeholder="Password" value="{{old('password_su')}}">

    <!-- Hiển thị thông báo lỗi cho trường 'address_su' -->
    @error('address_su')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="address_input_signup" name="address_su" type="text" placeholder="Địa Chỉ" value="{{old('address_su')}}">

    <!-- Hiển thị thông báo lỗi cho trường 'phone_su' -->
    @error('phone_su')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="phone_input_signup" name="phone_su" type="text" placeholder="Số Điện Thoại" value="{{old('phone_su')}}">

    <button type="submit" class="sign-up">Đăng Ký</button>
                </div>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form class="form" action="{{ route('checkUserLogin') }}" method="POST">
                @csrf
                <h1>Đăng Nhập</h1>
                <input name="email" class="email_input" type="email" placeholder="Email" autocomplete="on"
                    value="{{ old('email') ?? session('user') ?? session('email')  }} ">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input name="password" class="password_input" type="password" placeholder="Password"
                    value="{{ session('password') }}">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <a class="forget-pass_button">Quên Mật Khẩu?</a>
                @error('emailFindPass')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @if (session('msg'))
                <div class="alert alert-danger">{{ session('msg') }}</div>
                @endif
                <button type="submit" class="sign-in">Đăng Nhập</button>
            </form>
           
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào mừng!</h1>
                    <p>Hãy đăng nhập nếu bạn đã có một tài khoản nha !!!</p>
                    <button class="ghost" id="signIn">Đăng Nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Chào bạn!</h1>
                    <p>Hãy tạo một tài khoản để trải nghiệm website</p>
                    <button class="ghost" id="signUp">Đăng Ký Ngay</button>
                </div>
            </div>
        </div>
    </div>

<div class="forget_pass_form">
    <form action="{{route('forget_pass')}}" method="POST">
        @csrf
       
        <input class="forget_pass_input" name="emailFindPass" type="text" placeholder="Nhập email của bạn để kích hoạt">
        <input class="forget_pass_submit" type="submit" value="Xác Nhận">
    </form>
</div>
<div class="overlay1"></div>
</body>

</html>
