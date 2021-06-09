@extends('layouts.app')

@section('content')
    
    <h3 align="center">Пәндер</h3>
    <br/>
    @auth
    <div class="flex justify-center">
        <div class="form-group">
            <form method="GET" action="{{ route('subject.list') }}">
                {{ csrf_field() }}
                <label>Мамандық</label>
                <select class="form-select" name="speciality" id="speciality">
                    @foreach ($profs as $prof)
                        <option value="{{ $prof->short_name }}">{{ $prof->short_name }}</option>
                    @endforeach                            
                </select>
                <br/>
                <div class="form-group">
                    <div class="col-md-6">
                      <input type="submit" name="download" value='Пәндер тізімі' class='btn btn-success'>
                    </div>
                </div>
            </form>

        </div>
        <div id="main" class="w-8/12 bg-white p-6 rounded-lg">
            <div class="input-group rounded">
                {{-- <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                  aria-describedby="search-addon" /> --}}
                <select class="form-select" aria-label="Default select example" name="course" id="course">
                    <option value="2" selected>2 курс</option>
                    <option value="3">3 курс</option>
                    <option value="4">4 курс</option>
                </select> 
                <select class="form-select" aria-label="Default select example" name="semester" id="semester">
                    <option value="1" selected>1 семестр</option>
                    <option value="2">2 семестр</option>
                </select>
                <button class="btn btn-primary" id="search" type="submit" onclick="myFunction()">
                    Іздеу
                </button>

            </div>
                <table id="subj_table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th id="id" scope="col">#</th>
                            <th scope="col">Курс</th>
                            <th scope="col">Мамандық</th>
                            <th scope="col">Пән атауы</th>
                            <th scope="col">Оқытушы</th>
                            <th scope="col">Сағат саны</th>
                            <th scope="col">Cеместр</th>
                            <th scope="col">Сынақ түрі</th>
                            <th scope="col">Әрекет</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $key => $subject )
                            <tr id={{ $subject->id }}>
                                <td scope="row">{{ ++$key }}</td>
                                <td scope="row">{{ $subject->course }}</td>
                                <td scope="row">{{ $subject->speciality }}</td>
                                <td scope="row">{{ $subject->subject }}</td>
                                <td scope="row">{{ $subject->teacher }}</td>
                                <td scope="row">{{ $subject->hours }}</td>
                                <td scope="row">{{ $subject->semester }}</td>
                                <td scope="row">{{ $subject->exam }}</td>
                                <td scope="row"> 
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <button id="del" value="{{ $subject->id }}" class="btn btn-danger btn-md" onclick="deleteSubject({{ $subject->id }})">Жою</button>
                                         </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <br/>
            <button class="btn btn-primary" type="submit">
                <a class="text-white" href="{{ route('subjects.insert') }}">Пән енгізу</a>
            </button>
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
    <script>
        let deleteSubject = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/subjects/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {subject_id: id},
                    success: status_code => {
                        if (status = 200) {
                            window.location.reload(true);
                        }else {
                            alert("Упс... Қайта көріңіз");
                        }
                    }
                });
            }
        } 
    </script>
    <script>
        function myFunction() {
            var input = document.getElementById("course");
            var input2 = document.getElementById("semester");
            var filter = input.value.toUpperCase();
            var filter2 = input2.value.toUpperCase();

            var rows = document.querySelector("#subj_table tbody").rows;
            
            for (var i = 0; i < rows.length; i++) {
                var firstCol = rows[i].cells[1].textContent.toUpperCase();
                var secondCol = rows[i].cells[6].textContent.toUpperCase();
                if (firstCol.indexOf(filter) > -1 && secondCol.indexOf(filter2) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }      
            }
        }
    </script>
@endsection