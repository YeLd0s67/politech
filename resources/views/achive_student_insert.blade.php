@extends('layouts.app')

@section('content')
    @guest
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            Жұмыс жасау үшін, Кіру немес Тіркелу керек
        </div>
    </div>  
    @endguest
    @auth

    <h3 align="center">Студент жетістігін еңгізу</h3>
    <br/>        
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form method="post" action="{{ route('student.achives.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Студенттің аты-жөні</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Тобы</label>
                    <select class="form-select" aria-label="Default select example" name="groups" id="groups">   
                        @foreach ($groups as $group)
                            <option value='{{ $group->group }}'>{{ $group->group }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Жетекшісі</label>
                    <input type="text" name="advisor" id="advisor" class="form-control" value="" />

                </div>
                <div class="form-group">
                    <label>Қатысқан іс-шара</label>
                    <select class="form-select" aria-label="Default select example" name="shara" id="shara">   
                        <option value='Байқау'>Байқау</option>
                        <option value='Конференция'>Конференция</option>
                        <option value='Олимпиада'>Олимпиада</option>
                        <option value='Хакатон'>Хакатон</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Деңгейі</label>
                    <select class="form-select" aria-label="Default select example" name="level" id="level">   
                        <option value='Халықаралық'>Халықаралық</option>
                        <option value='Республикалық'>Республикалық </option>
                        <option value='Облыстық'>Облыстық </option>
                        <option value='Қалалық'>Қалалық</option>
                        <option value='Колледжішілік'>Колледжішілік</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Қатысқан іс-шара атауы</label>
                    <input type="text" name="shara_name" id="shara_name" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Мерзімі</label>
                    <input type="text" name="period" id="period" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Марапаты</label>
                    <select class="form-select" aria-label="Default select example" name="achivement" id="achivement">   
                        <option value='Бас жүлде'>Бас жүлде</option>
                        <option value='І-дәрежелі диплом'>І-дәрежелі диплом</option>
                        <option value='ІІ-дәрежелі диплом'>ІІ-дәрежелі диплом </option>
                        <option value='ІІІ-дәрежелі диплом'>ІІІ-дәрежелі диплом</option>
                        <option value='Сертификат'>Сертификат</option>
                        <option value='Алғыс хат'>Алғыс хат</option>
                        <option value='Номинация'>Номинация </option>
                    </select>
                </div>
                <div align="right" class="form-group">
                    <input style="color: white" type="submit" name="send" class="btn btn-info" value="Еңгізу" />
                </div>             
            </form>
        </div>
    </div>
            
    @endauth
@endsection