<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn</title>
</head>
<body>
    @foreach($hoaDon as $h)
    <p>{{$h->id}}</p>
    @endforeach
</body>
</html>