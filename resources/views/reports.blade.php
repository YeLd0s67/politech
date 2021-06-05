@extends('layouts.app')

@section('content')
    <h3 align="center">Есептер</h3>
    <br/>
    @auth
        <div class="flex justify-center">
            <div class="w-10/12 bg-white p-6 rounded-lg">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('reports.structure') }}">Оқытушылардың сандық және сапалық құрамы</a></button>
                    <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('reports.courses') }}">Біліктілік курстары</a></button>
                    <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('reports.internships') }}">Тағылымдамалар </a></button>
                    <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('reports.activity') }}">Медиажоспар </a></button>
                    <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('reports.achivements') }}">Оқытушылардың жетістіктері </a></button>
                </div>
            </div>
        </div>
    @endauth
    @guest
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            Жұмыс жасау үшін, Кіру немес Тіркелу керек
        </div>
    </div>  
    @endguest
@endsection