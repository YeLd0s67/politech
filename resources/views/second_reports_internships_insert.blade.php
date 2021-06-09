@extends('layouts.app')

@section('content')
    
    <h3 align="center">Оқытушылардың тағлымдамадан өтуін енгізу</h3>
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
            <form method="POST" action="{{ route('internships.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Педагогтің тегі, аты, әкесінің аты</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Тағылымдама өтілу мамандығы</label>
                    <input type="text" name="prof" id="prof" class="form-control" value="" />

                </div>

                <div class="form-group">
                    <label>Тағылымдама өтілу орны</label>
                    <input type="text" name="place" id="place" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Тағылымдама өтілу лауазымы</label>
                    <input type="text" name="employement" id="employement" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Тағылымдама өтілу мерзімі</label>
                    <input type="date" name="date" id="date" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Аяқталу мерзімі</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Хаттама №</label>
                    <input type="text" name="message" id="message" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Сертификаттың суреті<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='file' name='pic' class="form-control">
       
                      @if ($errors->has('file'))
                        <span class="errormsg text-danger">{{ $errors->first('file') }}</span>
                      @endif
                    </div>
                </div>

                <div class="form-group">
                    <label>Жылы</label>
                    <input type="text" name="year" id="year" class="form-control" value="" />
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