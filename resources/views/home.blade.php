<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Жамбыл политехникалық жоғары колледжі</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet"> 
    <style type="text/css">
    html,body{
        margin:0;
        height:100%;
        overflow:hidden;
    }
    </style>
</head>
<body>
    @auth
        <script>window.location = "/welcome"</script>
    @endauth
    @guest
        <p style="font-family: 'Roboto Slab', serif; margin: 50px; position: absolute;" class="text-black text-2xl p-3">Жамбыл политехникалық жоғары колледжі</p>
        <button type="button" style="margin: 50px; position: absolute; right: 0" class="btn btn-dark"><a style="font-family: 'Roboto Slab', serif;" href="{{ route('login') }}" class="text-white ">Кіру</a></button>
        <section class="hero container max-w-screen-lg mx-auto pb-10 flex justify-center">
            <img src="images/main.png" alt="centered image" />
        </section>

    @endguest
</body>