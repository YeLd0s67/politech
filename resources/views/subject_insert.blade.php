@extends('layouts.app')

@section('content')
    
    <h3 align="center">Пән Еңгізу</h3>
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
            <form method="POST" action="{{ route('subjects.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Курс</label>
                    <select class="form-select" aria-label="Default select example" name="course" id="course">
                      <option value="2" selected>2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select>  
                </div>
                <div class="form-group">
                    <label>Мамандық</label>
                    <select class="form-select" aria-label="Default select example" name="speciality" id="speciality">
                        @foreach ($profs as $prof)
                            <option value="{{ $prof->short_name }}">{{ $prof->short_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Пән атауы</label>
                    <input type="text" name="subject" id="subject" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Оқытушы</label>
                    <select class="form-select" aria-label="Default select example" name="teacher" id="teacher">
                      <option value="-" selected>-</option>
                      @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->last_name . ' ' . $teacher->first_name }}" >{{ $teacher->last_name .' ' . $teacher->first_name }}</option>
                      @endforeach

                    </select>  
                </div>
                <div class="form-group">
                    <label>Сағат саны</label>
                    <input type="text" name="hours" id="hours" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Cеместр</label>
                    <select class="form-select" aria-label="Default select example" name="semester" id="semester">
                      <option value="1" selected>1</option>
                      <option value="2">2</option>
                  </select>  
                </div>
                <div class="form-group">
                    <label>Сынақ түрі</label>
                    <input type="text" name="exam" id="exam" class="form-control" value="" />
                </div>
                  <div class="form-group">
                    <div class="col-md-6">
                      <input type="submit" name="submit" value='Еңгізу' class='btn btn-success'>
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