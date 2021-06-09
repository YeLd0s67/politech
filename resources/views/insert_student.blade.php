@extends('layouts.app')

@section('content')
    
    <h3 align="center">Студент енгізу</h3>
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
                    {{ session()->get('message') }}
                </div>
            @endif
            <form method="post" action="{{ route('student.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Студенттің аты-жөні</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Туылған күні, айы, жылы</label>
                    <input type="date" name="date" id="date" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Тобы</label>
                    <select class="form-select" aria-label="Default select example" name="group" id="group">   
                        @foreach ($groups as $group)
                            <option value='{{ $group->group }}'>{{ $group->group }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Курсы</label>
                    <select class="form-select" aria-label="Default select example" name="course" id="course">   
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                    </select>
                </div>
                <div align="right" class="form-group">
                    <input style="color: white" type="submit" name="send" class="btn btn-info" value="Енгізу" />
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