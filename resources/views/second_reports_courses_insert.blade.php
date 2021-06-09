@extends('layouts.app')

@section('content')
    
    <h3 align="center">Біліктілік курстарын енгізу</h3>
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
            <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Оқытушының аты жөні</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Өткен орны</label>
                    <input type="text" name="place" id="place" class="form-control" value="" />

                </div>

                <div class="form-group">
                    <label>Оқыту бағдарламасы</label>
                    <input type="text" name="programm" id="programm" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Пәні</label>
                    <input type="text" name="subject" id="subject" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Өтілу түрі</label>
                    <select class="form-select" aria-label="Default select example" name="type" id="type">
                        <option value="Күндізгі">Күндізгі</option>
                        <option value="қашықтықтан">Қашықтықтан</option>
                    </select> 
                </div>

                <div class="form-group">
                    <label>Оқыту түрі</label>
                    <select class="form-select" aria-label="Default select example" name="lang" id="lang">
                        <option value="Қазақ">Қазақ</option>
                        <option value="Орыс">Орыс</option>
                        <option value="Ағылшын">Ағылшын</option>
                        <option value="Ғылымдар докторы">Ғылымдар докторы</option>
                        <option value="PhD докторы">PhD докторы</option>
                        <option value="Бағдар бойынша доктор">Бағдар бойынша доктор</option>
                    </select> 
                </div>

                <div class="form-group">
                    <label>Курстың өтілу уақыты, сағаты</label>
                    <input type="text" name="date" id="date" class="form-control" value="" />
                </div>
                
                <div class="form-group">
                    <label>Курстың басталған уақыты</label>
                    <input type="text" name="start_date" id="start_date" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Курстың аяқталған уақыты</label>
                    <input type="text" name="end_date" id="end_date" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Жылы</label>
                    <input type="text" name="year" id="year" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Сертификат (грамота, диплом) номері № </label>
                    <input type="text" name="certificate_no" id="certificate_no" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Сертификаттың суреті<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='file' name='certificate_picture' class="form-control">
       
                      @if ($errors->has('file'))
                        <span class="errormsg text-danger">{{ $errors->first('file') }}</span>
                      @endif
                    </div>
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