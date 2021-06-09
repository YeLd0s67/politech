@extends('layouts.app')

@section('content')
    
    <h3 align="center">Оқу жұмыс жоспарлары</h3>
    <br/>
    @auth
    <div class="flex justify-center">
        <div id="main" class="w-8/12 bg-white p-6 rounded-lg">
                <div class="form-group">
                    <label>Мамандық шифры</label>
                    <select class="form-select" name="spec_code" id="spec_code">
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->spec_code }}">{{ $plan->spec_code }}</option>                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Мамандық атауы</label>
                    <select class="form-select" name="spec_name" id="spec_name">
                    </select>
                </div>
                <div class="form-group">
                    <label>Біліктілік </label>
                    <select class="form-select" name="" id="prof">
                    </select>
                </div>
                <br/>

                <button class="btn btn-primary" id="download" type="submit">Оқу жоспарын жүктеу</button>
        </div>
        <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('plans.insert') }}">Жоспар енгізу</a></button>
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
        $(document).on('click', '#spec_code',function(){
            var spec_code = $(this).val();
            $.ajax({
                type:'GET',
                url:"{{ route('plans.get.name') }}",
                data:{'spec_code':spec_code},
                success:function(data){
                    $('#spec_name').html(data);
                }
            });
        });
        $(document).on('click', '#spec_name',function(){
            var spec_name = $(this).val();
            $.ajax({
                type:'GET',
                url:"{{ route('plans.get.prof') }}",
                data:{'spec_name':spec_name},
                success:function(data){
                    $('#prof').html(data);
                }
            });
        });
        $(document).on('click', '#download',function(){
            var spec_code = $('#spec_code').val();
            var spec_name = $('#spec_name').val();
            var prof = $('#prof').val();
            $.ajax({
                type:'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('plans.download') }}",
                data:{'spec_code':spec_code, 'spec_name':spec_name, 'prof':prof },
                success:function(data){     
                    window.location = 'plans/'+data;                           
                }
            });
        });
        var usedNames = {};
        $("select[name='spec_code'] > option").each(function () {
            if(usedNames[this.text]) {
                $(this).remove();
            } else {
                usedNames[this.text] = this.value;
            }
        });
    </script> 
    
@endsection