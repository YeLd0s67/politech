@extends('layouts.app')

@section('content')
    
    <h3 align="center">Оқу жұмыс жоспарлары</h3>
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
            <form method="POST" action="{{ route('plans.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Мамандық шифры</label>
                    <input type="text" name="spec_code" id="spec_code" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Мамандық атауы</label>
                    <input type="text" name="spec_name" id="spec_name" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Біліктілік</label>
                    <input type="text" name="prof" id="prof" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Құжат <span class="required">*</span></label>
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