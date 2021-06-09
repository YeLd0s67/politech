@extends('layouts.app')

@section('content')
    
    <h3 align="center">Қосымша лауазым</h3>
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
            <form method="POST" action="{{ route('employment.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Оқытушы</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Лауазым</label>
                    <input type="text" name="employment" id="employment" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Мөлшерлеме</label>
                    <input type="text" name="molsher" id="molsher" class="form-control" value="" />
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
    <script type="text/javascript">
        function Citizen(val){
         var element=document.getElementById('other_citizen');
         if(val=='others')
           element.style.display='block';
         else  
           element.style.display='none';
        }
        function Nation(val){
         var element=document.getElementById('other_nation');
         if(val=='others')
           element.style.display='block';
         else  
           element.style.display='none';
        }
        
    </script> 
@endsection