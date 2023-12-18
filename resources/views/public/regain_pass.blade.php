<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <style>
        .container {
            margin: 0 auto;
            padding :10px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-direction: column;
            margin-top: 100px;
           
            
        }
        .form-group {
            padding: 10px
        }
        
    </style>
    
</head>
<body>
    @if($check)
    <div class="container">
        <form action="{{route('setNewPass')}}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{$email}}">
        <input name="newpass" class="form-group" type="text" placeholder="Nhập Mật Khẩu Mới">
        <input class="form-group" type="text " placeholder="Nhập Lại Mật Khẩu Mới">
        <button class="btn btn-success " type="submit " >Xác Nhận</button>
    </form>
    </div>
    @else
    <h1>Không đúng thông tin xác thực</h1>
    @endif
</body>
</html>