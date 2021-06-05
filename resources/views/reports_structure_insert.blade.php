@extends('layouts.app')

@section('content')
    
    <h3 align="center">Оқытушылардың сандық және сапалық құрамын еңгізу</h3>
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
            <form method="POST" action="{{ route('reports.structure.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Оқытушының аты жөні</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Санаты</label>
                    <select class="form-select" aria-label="Default select example" name="sanat" id="sanat">
                        <option value="Cанаты жоқ">Cанаты жоқ</option>
                        <option value="Екінші санатты">Екінші санатты</option>
                        <option value="Бірінші санатты">Бірінші санатты</option>
                        <option value="Жоғары санатты">Жоғары санатты</option>
                        <option value="Педагог">Педагог</option>
                        <option value="Педагог - модератор">Педагог - модератор</option>
                        <option value="Педагог – сарапшы">Педагог – сарапшы</option>
                        <option value="Педагог – зерттеуші">Педагог – зерттеуші</option>
                        <option value="Педагог – шебер">Педагог – шебер</option>
                    </select>  
                </div>

                <div class="form-group">
                    <label>Санаты берілген уақыты</label>
                    <input type="date" name="sanat_start_date" id="sanat_start_date" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Санаты аяқталған уақыты</label>
                    <input type="date" name="sanat_end_date" id="sanat_end_date" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Куәлік номері № </label>
                    <input type="text" name="certificate_no" id="certificate_no" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Куәлік суреті<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='file' name='certificate_picture' class="form-control">
       
                      @if ($errors->has('file'))
                        <span class="errormsg text-danger">{{ $errors->first('file') }}</span>
                      @endif
                    </div>
                </div>
                <div class="form-group">
                    <label>Ғылыми дәрежесі</label>
                    <select class="form-select" aria-label="Default select example" name="dareje" id="dareje">
                        <option value="Дәрежесі жоқ">Дәрежесі жоқ</option>
                        <option value="Магистр">Магистр</option>
                        <option value="Ғылым кандидаты">Ғылым кандидаты</option>
                        <option value="Ғылымдар докторы">Ғылымдар докторы</option>
                        <option value="PhD докторы">PhD докторы</option>
                        <option value="Бағдар бойынша доктор">Бағдар бойынша доктор</option>
                    </select> 
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