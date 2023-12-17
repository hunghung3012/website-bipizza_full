<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js" defer></script>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('addUser') }}" method="POST">
                @csrf
                <div class="form">
                    <h1>Tạo Tài Khoản</h1>
                    <input class="name_input_signup" name="name_su" type="text" placeholder="Họ Và Tên">
                    <input class="email_input_signup" name="email_su" type="text" placeholder="Email">
                    <input class="pass_input_signup" name="password_su" type="password" placeholder="Password">
                    <input class="address_input_signup" name="address_su" type="text" placeholder="Địa Chỉ">
                    <input class="phone_input_signup" name="phone_su" type="text" placeholder="Số Điện Thoại">
                    <button type="submit" class="sign-up">Đăng Ký</button>
                </div>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form class="form" action="{{ route('checkUserLogin') }}" method="POST">
                @csrf
                <h1>Đăng Nhập</h1>
                <input name="email" class="email_input" type="text" placeholder="Email"
                    value="{{ old('email') ?? session('user') }}">
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
                <input name="password" class="password_input" type="password" placeholder="Password"
                    value="{{ session('password') }}">
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
                <a href="#">Quên Mật Khẩu?</a>
                @if (session('msg'))
                    <p class="a">{{ session('msg') }}</p>
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


</body>

</html>
