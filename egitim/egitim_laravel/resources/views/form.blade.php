<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Örnek Form Sayfası</title>
</head>
<body>
<form action="{{ route("sonuc") }}" method="post">
    @csrf

    <textarea name="metin" cols="30" rows="10"></textarea><br>
    <input type="submit" name="ilet" value="Gönder">

</form>
</body>
</html>

Ornek form sayfası
