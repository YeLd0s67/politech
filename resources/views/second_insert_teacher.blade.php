@extends('layouts.app')

@section('content')
    
    <h3 align="center">Оқытушы</h3>
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
            <form method="post" action="{{ route('second.insert.send') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>ЖСН</label>
                    <input type="text" name="iin" id="iin" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Тегі</label>
                    <input type="text" name="surename" id="surname" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Аты</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Әкесінің аты</label>
                    <input type="text" name="middle" id="middle_name" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Туған күні</label>
                    <input type="date" name="birthday" id="birthday" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Жынысы</label>
                    <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                        <option value="Еркек" selected>Еркек</option>
                        <option value="Әйел">Әйел</option>
                    </select>                
                </div>
                <div class="form-group">
                    <label>Азаматтығы</label>
                    <select class="form-select" aria-label="Default select example" name="citizen" onchange='Citizen(this.value);'> 
                        <option value="Қазақстан">Қазақстан</option>
                        <option value="Басқа">Басқа</option>
                    </select>
                    <input type="text" name="other_citizen" class="form-control" value="" id="other_citizen" style='display:none;' />
                </div>
                <div class="form-group">
                    <label>Ұлты</label>
                    <select class="form-select" aria-label="Default select example" name="nation" onchange='Nation(this.value);'> 
                        <option value="Қазақ">Қазақ</option>
                        <option value="Басқа">Басқа</option>
                    </select>
                    <input type="text" name="other_nation" class="form-control" value="" id="other_nation" style='display:none;' />
                </div>
                <div class="form-group">
                    <label>Қызметкердің ағымдағы мәртебесі</label>
                    <select class="form-select" aria-label="Default select example" name="responsibility" id="responsibility">
                        <option value="Осы ұйымда жұмыс істейді">Осы ұйымда жұмыс істейді</option>
                        <option value="Декреттік демалыста">Декреттік демалыста</option>
                        <option value="Ауру себебінен демалыста">Ауру себебінен демалыста</option>
                        <option value="Әскерде">Әскерде</option>
                        <option value="Еңбек ақысы сақталмайтын демалыста">Еңбек ақысы сақталмайтын демалыста</option>
                    </select>   
                </div>
                <div class="form-group">
                    <label>Лауазым</label>
                    <select class="form-select" aria-label="Default select example" name="rank" id="rank">
                        <option value="Әлеуметтік педагог">Әлеуметтік педагог</option>
                        <option value="Аға шебер">Аға шебер</option>
                        <option value="Жалпы білім беретін пәндер бойынша оқытушы">Жалпы білім беретін пәндер бойынша оқытушы</option>
                        <option value="Өндірістік оқыту шебері">Өндірістік оқыту шебері</option>
                        <option value="Жалпы кәсіптік және арнайы пәндер бойынша оқытушы">Жалпы кәсіптік және арнайы пәндер бойынша оқытушы</option>
                    </select> 
                </div>
                <div class="form-group">
                    <label>Қызметкер</label>
                    <select class="form-select" aria-label="Default select example" name="work_type" id="work_type">
                        <option value="Штаттық">Штаттық</option>
                        <option value="Қоса атқарушы">Қоса атқарушы</option>
                    </select> 
                </div>
                <div class="form-group">
                    <label>Академиялық, ғылыми дәреже</label>
                    <select class="form-select" aria-label="Default select example" name="academic_degree" id="academic_degree">
                        <option value="Дәрежесі жоқ">Дәрежесі жоқ</option>
                        <option value="Магистр">Магистр</option>
                        <option value="Ғылым кандидаты">Ғылым кандидаты</option>
                        <option value="Ғылымдар докторы">Ғылымдар докторы</option>
                        <option value="PhD докторы">PhD докторы</option>
                        <option value="Бағдар бойынша доктор">Бағдар бойынша доктор</option>
                    </select> 
                </div>
                <div class="form-group">
                    <label>Білімі</label>
                    <select class="form-select" aria-label="Default select example" name="educ" id="educ">
                        <option value="Жоғары (кәсіптік)">Жоғары (кәсіптік)</option>
                        <option value="Жоғары (педагогикалық)">Жоғары (педагогикалық)</option>
                        <option value="Жоғары (мектепке дейінгі)">Жоғары (мектепке дейінгі)</option>
                        <option value="Техникалық және кәсіптік білім">Техникалық және кәсіптік білім</option>
                        <option value="Техникалық және кәсіптік (педагогикалық)">Техникалық және кәсіптік (педагогикалық)</option>
                        <option value="Техникалық және кәсіптік (мектепке дейінгі)">Техникалық және кәсіптік (мектепке дейінгі)</option>
                        <option value="Жалпы орта білім">Жалпы орта білім</option>
                    </select> 
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="flexCheckDefault">
                        ЖОО-да оқиды (в текущий период)
                    </label>
                    <select class="form-select" aria-label="Default select example" name="study" id="educ">
                        <option value="Иә">Иә</option>
                        <option value="Жоқ">Жоқ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Жұмысқа қабылдау кезіндегі жалпы еңбек өтілі</label>
                    <input type="text" name="pre_work_history" id="pre_work_history" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Ағымдағы мерзімдегі жалпы еңбек өтілі</label>
                    <input type="text" name="curr_overall_history" id="curr_overall_history" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Ағымдағы мерзімдегі педагогикалық еңбек өтілі</label>
                    <input type="text" name="curr_ped_history" id="curr_ped_history" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Осы ұйымдағы жалпы еңбек өтілі</label>
                    <input type="text" name="overall_work_history" id="overall_work_history" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Тұрғылықты мекен-жайы</label>
                    <input type="text" name="address" id="address" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Электронды адрес (Е-mail)</label>
                    <input type="text" name="email" id="email" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Ұялы телефон (нөмірі)</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="" />
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
                    <label>Оқыту тілі</label>
                    <select class="form-select" aria-label="Default select example" name="edu_lang" id="edu_lang">
                        <option value="Қазақ">Қазақ</option>
                        <option value="Орыс">Орыс</option>
                        <option value="Ағылшын">Ағылшын</option>
                    </select>                  
                </div>
                <div class="form-group">
                    <label>Ағылшын тілін білу деңгейі</label>
                    <select class="form-select" aria-label="Default select example" name="english" id="english">
                        <option value="Beginner">Beginner</option>
                        <option value="Elementary">Elementary</option>
                        <option value="Pre-Intermediate">Pre-Intermediate</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Upper – Intermediate">Upper – Intermediate</option>
                        <option value="Advanced">Advanced</option>
                        <option value="Profciency">Profciency</option>
                        <option value="IELTS">IELTS</option>
                        <option value="TOEFL">TOEFL</option>
                        <option value="Ағылшын тілін білмейді">Ағылшын тілін білмейді</option>
                    </select> 
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