@extends('layouts.app')

@section('content')
    
    <h3 align="center">Мамандық Еңгізу</h3>
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
            <form method="POST" action="{{ route('profs.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Шифр</label>
                    <input type="text" name="code" id="code" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Толық атауы</label>
                    <input type="text" name="description" id="description" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Қысқартылған атауы </label>
                    <input type="text" name="short_name" id="short_name" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Топтар</label>
                    <select class="form-select" aria-label="Default select example" name="groups" id="groups">
                      <option value="111" selected>111</option>
                      {{-- @foreach ($profs as $profs)
                        <option value="{{ $profs->groups }}" >{{ $profs->groups }}</option>
                      @endforeach --}}
                    </select>  
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Оқу үрдісінің кестесі <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='file' name='file' class="form-control">
       
                      @if ($errors->has('file'))
                        <span class="errormsg text-danger">{{ $errors->first('file') }}</span>
                      @endif
                    </div>
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