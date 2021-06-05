@extends('layouts.app')

@section('content')
    @auth
        
    <h3 align="center">Топ еңгізу</h3>
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
            <form method="post" action="{{ route('group.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Топ</label>
                    <input type="text" name="group" id="group" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Оқуға түскен жылы</label>
                    <input type="date" name="date" id="date" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Бұйрық</label>
                    <input type="text" name="order" id="order" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Куратор</label>
                    <input type="text" name="advisor" id="advisor" class="form-control" value="" />
                </div>
                <div align="right" class="form-group">
                    <input style="color: white" type="submit" name="send" class="btn btn-info" value="Еңгізу" />
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

    <script type="text/javascript">
        function Citizen(val){
         var element=document.getElementById('other_citizen');
         if(val=='Басқа')
           element.style.display='block';
         else  
           element.style.display='none';
        }
        function Nation(val){
         var element=document.getElementById('other_nation');
         if(val=='Басқа')
           element.style.display='block';
         else  
           element.style.display='none';
        }
        
    </script> 
@endsection