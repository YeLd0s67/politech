@extends('layouts.app')

@section('content')
    
    <h3 align="center">Мамандықтар </h3>
    <br/>
    @auth
    <div class="flex justify-center">
        <div id="main" class="w-8/12 bg-white p-6 rounded-lg">
                <div class="form-group">
                    <label>Шифры</label>
                    <select class="form-select" name="code" id="code">
                        @foreach ($profs as $prof)
                            <option value="{{ $prof->code }}">{{ $prof->code }}</option>                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Толық атауы</label>
                    <select class="form-select" name="description" id="description">
                    </select>
                </div>
                <div class="form-group">
                    <label>Қысқартылған атауы</label>
                    <select class="form-select" name="short" id="short">
                    </select>
                </div>
                <div class="form-group">
                    <label>Топтар</label>
                    <select class="form-select" name="group" id="group">
                    </select>
                </div>
                <br/>

                <button class="btn btn-primary" id="download" type="submit">Оқу үрдісінің кестесін жүктеу</button>
        </div>
        <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('profs.insert') }}">Мамандық енгізу</a></button>
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
    
        $(document).on('click', '#code',function(){
            var code = $(this).val();
            $.ajax({
                type:'GET',
                url:"{{ route('profs.get.desc') }}",
                data:{'code':code},
                success:function(data){
                    $('#description').html(data);
                }
            });
        });
        $(document).on('click', '#description',function(){
            var description = $(this).val();
            $.ajax({
                type:'GET',
                url:"{{ route('profs.get.short') }}",
                data:{'description':description},
                success:function(data){
                    $('#short').html(data);
                }
            });
        });
        $(document).on('click', '#short',function(){
            var short = $(this).val();
            $.ajax({
                type:'GET',
                url:"{{ route('profs.get.group') }}",
                data:{'short':short},
                success:function(data){
                    $('#group').html(data);
                }
            });
        });
        $(document).on('click', '#download',function(){
            var code = $('#code').val();
            var description = $('#description').val();
            var short = $('#short').val();
            var group = $('#group').val();
            $.ajax({
                type:'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('profs.download') }}",
                data:{'code':code, 'description':description, 'short':short, 'group':group },
                success:function(data){     
                    window.location = 'profs/'+data;                           
                }
            });
        });
        var usedNames = {};
        $("select[name='code'] > option").each(function () {
            if(usedNames[this.text]) {
                $(this).remove();
            } else {
                usedNames[this.text] = this.value;
            }
        });
    </script> 
    
@endsection