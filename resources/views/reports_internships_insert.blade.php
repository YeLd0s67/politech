@extends('layouts.app')

@section('content')
    
    <h3 align="center">Тағылымдамаларды енгізу</h3>
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
            <form method="POST" action="{{ route('reports.internships.store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Педагогтің тегі, аты, әкесінің аты</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Қызметі</label>
                    <select class="form-select" aria-label="Default select example" name="service" id="service">
                        <option value="Арнайы пән оқытушысы">Арнайы пән оқытушысы</option>
                        <option value="ӨОШ">ӨОШ</option>
                    </select> 
                </div>

                <div class="form-group">
                    <label>Тағылымдамадан өткен лауазымы</label>
                    <input type="text" name="post" id="post" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Алған біліктілігі</label>
                    <input type="text" name="edu_received" id="edu_received" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Хаттама</label>
                    <input type="text" name="message" id="message" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Жылы</label>
                    <input type="text" name="date" id="date" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Тағылымдама өтілу орны</label>
                    <input type="text" name="place" id="place" class="form-control" value="" />
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