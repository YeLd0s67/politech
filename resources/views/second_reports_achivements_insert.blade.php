@extends('layouts.app')

@section('content')
    
    <h3 align="center">Оқытушылардың жетістіктерін енгізу</h3>
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
            <form method="POST" action="{{ route('achivements.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Оқытушының аты жөні</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Тақырып атауы</label>
                    <input type="text" name="topic" id="topic" class="form-control" value="" />

                </div>

                <div class="form-group">
                    <label>Байқау атауы</label>
                    <input type="text" name="contest" id="contest" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Өткен жері</label>
                    <input type="text" name="place" id="place" class="form-control" value="" />

                </div>

                <div class="form-group">
                    <label>Жылы </label>
                    <input type="text" name="year" id="year" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Байқау деңгейі</label>
                    <select class="form-select" aria-label="Default select example" name="level" id="level">   
                        <option value='Халықаралық'>Халықаралық</option>
                        <option value='Республикалық'>Республикалық </option>
                        <option value='Облыстық'>Облыстық </option>
                        <option value='Қалалық'>Қалалық</option>
                        <option value='Колледжішілік'>Колледжішілік</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Алған орны</label>
                    <select class="form-select" aria-label="Default select example" name="win" id="win">   
                        <option value='Гран при'>Гран при</option>
                        <option value='І орын'>І орын </option>
                        <option value='ІІ орын'>ІІ орын </option>
                        <option value='ІІІ орын'>ІІІ орын</option>
                        <option value='Сертификат'>Сертификат</option>
                        <option value='Алғыс хат'>Алғыс хат</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Өтілген уақыты</label>
                    <input type="date" name="date" id="date" class="form-control" value="" />
                </div>
                
                <div class="form-group">
                    <label>Куәлік</label>
                    <input type="text" name="id_no" id="id_no" class="form-control" value="" />
                </div>
                

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Диплом (грамота) суреті<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='file' name='diplom' class="form-control">
                      @if ($errors->has('diplom'))
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