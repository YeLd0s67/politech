@extends('layouts.app')

@section('content')
    
    <h3 align="center">Медиажоспар енгізу</h3>
    <br/>
    @auth
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
                    {{ "Еңгізілді" }}
                </div>
            @endif
            <form method="POST" action="{{ route('reports.activity.store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Оқытушы аты-жөні</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Мақала тақырыбы</label>
                    <input type="text" name="topic" id="topic" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Орындалу уақыты</label>
                    <input type="text" name="date" id="date" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Әрекеті</label>
                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                        <option value="Орындалды">Орындалды</option>
                        <option value="Орындалмады">Орындалмады</option>
                    </select> 
                </div>

                <div class="form-group">
                    <label>Мақала шыққан баспасы</label>
                    <input type="text" name="edition" id="edition" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                      <input type="submit" name="submit" value='Енгізу' class='btn btn-success'>
                    </div>
                </div>
            </form>
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