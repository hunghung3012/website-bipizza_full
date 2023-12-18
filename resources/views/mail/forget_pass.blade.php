<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    

    boot
</head>
<body>
    
    <p class="text-align text-capitalize">Vui Lòng Click Vào Button phía dưới để lấy lại mật khẩu</p>
    <form action="{{route('regain_pass')}}" method="GET">
        @csrf
        <input type="hidden" name="key" value="{{$random_int}}">
        <input type="hidden" name="email" value="{{$email}}">
    <button type="submit"  class="btn btn-success">Xác Thực</button>
</form>

</body>
</html>