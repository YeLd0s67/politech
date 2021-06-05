@extends('layouts.app')

@section('content')
    <h3 align="center">Оқытушы</h3>
    <br/>
    @auth
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <ul class="list-group">
                @foreach ($teacher as $t )
                    <li class="list-group-item" style="display: inline-block;"><b>ЖСН:</b> {{ $t->iin }}</li>
                    <li class="list-group-item"><b>Тегі:</b> {{ $t->first_name }}</li>
                    <li class="list-group-item"><b>Аты:</b> {{ $t->last_name }}</li>
                    <li class="list-group-item"><b>Әкесінің аты:</b> {{ $t->middle_name }}</li>
                    <li class="list-group-item"><b>Туған күні:</b> {{ $t->date_birth }}</li>
                    <li class="list-group-item"><b>Жынысы:</b> {{ $t->gender }}</li>
                    @if ($t->citizen == 'Басқа')
                        <li class="list-group-item"><b>Азаматтығы:</b> {{ $t->other_citizen }}</li>    
                    @else 
                        <li class="list-group-item"><b>Азаматтығы:</b> {{ $t->citizen }}</li>   
                    @endif
                    
                    @if ($t->nation == 'Басқа')
                        <li class="list-group-item"><b>Ұлты:</b> {{ $t->other_nation }}</li>    
                    @else 
                        <li class="list-group-item"><b>Ұлты:</b> {{ $t->nation }}</li>   
                    @endif
                    <li class="list-group-item"><b>Қызметкердің ағымдағы мәртебесі:</b> {{ $t->current_status }}</li>
                    <li class="list-group-item"><b>Лауазым:</b> {{ $t->rank }}</li>
                    <li class="list-group-item"><b>Қызметкер:</b> {{ $t->type_of_busy }}</li>
                    <li class="list-group-item"><b>Академиялық, ғылыми дәреже:</b> {{ $t->academic_degree }}</li>
                    <li class="list-group-item"><b>Білімі:</b> {{ $t->degree }}</li>
                    <li class="list-group-item"><b>ЖОО-да оқиды (в текущий период):</b> {{ $t->studying }}</li>
                    <li class="list-group-item"><b>Жұмысқа қабылдау кезіндегі жалпы еңбек өтілі:</b> {{ $t->pre_work_history }}</li>
                    <li class="list-group-item"><b>Ағымдағы мерзімдегі жалпы еңбек өтілі:</b> {{ $t->curr_overall_work_history }}</li>
                    <li class="list-group-item"><b>Ағымдағы мерзімдегі педагогикалық еңбек өтілі:</b> {{ $t->curr_ped_work_history }}</li>
                    <li class="list-group-item"><b>Осы ұйымдағы жалпы еңбек өтілі:</b> {{ $t->company_work_history }}</li>
                    <li class="list-group-item"><b>Тұрғылықты мекен-жайы:</b> {{ $t->address }}</li>
                    <li class="list-group-item"><b>Ұялы телефон (нөмірі):</b> {{ $t->phone }}</li>
                    <li class="list-group-item"><b>Санаты:</b>{{ $t->sanat }}</li>
                    <li class="list-group-item"><b>Оқыту тілі:</b> {{ $t->lang }}</li>
                    <li class="list-group-item"><b>Ағылшын тілін білу деңгейі:</b> {{ $t->english_level }}</li>                                
                @endforeach
            </ul>
            <br>
            @foreach ($teacher as $t)
                <button style="float:right" id="more" class="btn btn-primary btn-md"><a href='{{ route('edit.teacher', ['id' => $t->id ]) }}' class="text-white"> Өзгерту</a> </button>                
            @endforeach


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