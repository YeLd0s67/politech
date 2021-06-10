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
    <style type="text/css">
    .box{
        width:600px;
        margin:0 auto;
        border:1px solid #ccc;
    }
    .has-error
    {
        border-color:#cc0000;
        background-color:#ffff99;
    }
    p {
        margin-bottom: 0px;
    }
    .form-group
    {
        margin-bottom: 20px; 
    }
    </style>
</head>
<body class="bg-gray-200 divide-y divide-light-blue-400">
    <nav class="p-6 bg-gray-900 flex justify-between ">
        <a href="{{ route('home') }}" class="text-white font-extrabold text-3xl	">
            <img src="/images/logo.png" width="200" height="75" style="border-radius: 10px"> 
        </a>
        <p class="text-white text-2xl p-3">Жамбыл политехникалық жоғары колледжі</p>
        <ul class="flex items-center">
            @auth
                <li>
                    <a href="" class="text-white text-2xl p-3 no-underline hover:underline ">{{ auth()->user()->name }}</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="text-white p-3 inline">
                        @csrf
                        <button type="submit" class="text-2xl bg-white rounded-lg p-1 text-gray-900 transform hover:scale-110 motion-reduce:transform-none" href="{{ route('logout') }}" >Шығу</button>
                    </form>
                </li>
            @endauth
            @guest
                <li>
                    <a href="{{ route('login') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Кіру</a>
                </li>
                {{-- <li>
                    <a href="{{ route('register') }}" class="p-3 text-white	no-underline hover:underline ">Тіркелу</a>
                </li>      --}}
            @endguest
            
        </ul>
    </nav>
    <nav class="p-2 bg-gray-900 mb-6">  
        @auth
        @if (auth()->user()->isZhuldyz())
            <ul style="text-align: center">
                <li style="display: inline-block;">
                    <a href="{{ route('teacher') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Оқытушылар</a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('plans') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Оқу жұмыс жоспарлары </a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('subjects') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Пәндер</a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('profs') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Мамандықтар</a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('groups') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Топтар</a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('students') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Студенттер</a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('reports') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Есептер</a>
                </li>
            </ul>
        @elseif (auth()->user()->isRaushan()))
            <ul style="text-align: center">
                <li style="display: inline-block;">
                    <a href="{{ route('second.teacher') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Оқытушылар туралы мәлімет</a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('employment') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Қосымша лауазым </a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('courses') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Біліктілігін арттыру курсы</a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('structure') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Оқытушылардың санатын есепке алу</a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('internships') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Оқытушылардың тағлымдамадан өтуі</a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ route('achivements') }}" class="text-white text-2xl p-3 no-underline hover:underline ">Оқытушылардың жетістіктері</a>
                </li>
            </ul>
        @endif
        @endauth
    </nav>
    @yield('content')
    
</body>

</html>