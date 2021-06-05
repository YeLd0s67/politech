@extends('layouts.app')

@section('content')
    <h3 align="center">Біліктілік курстары</h3>
    <br/>
    @auth
        <div class="flex justify-center">
            <div class="w-10/12 bg-white p-6 rounded-lg">
                <div class="form-group">
                    <form method="GET" action="{{ route('reports.courses.list') }}">
                        {{ csrf_field() }}
                        <label>Жылы</label>
                        <input type="text" name="year" id="year" class="form-control" value="" />
                        <div class="col-md-6">
                           <input type="submit" name="download" value='Жүктеу' class='btn btn-success'>
                        </div>
                    </form>
                </div>
                <div class="input-course rounded">
                    <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                      aria-describedby="search-addon" />
                </div>
                    <table id="course_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th id="id" scope="col">#</th>
                                <th scope="col">Оқытушының аты жөні</th>
                                <th scope="col">Өткен орны</th>
                                <th scope="col">Оқыту бағдарламасы</th>
                                <th scope="col">Пәні</th>
                                <th scope="col">Өтілу түрі</th>
                                <th scope="col">Оқыту түрі</th>
                                <th scope="col">Курстың өтілу уақыты, сағаты</th>
                                <th scope="col">Сертификат (грамота, диплом) номері № </th>
                                <th scope="col">Сертификаттың суреті </th>
                                <th scope="col">Жылы </th>
                                <th scope="col">Әрекет </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $key => $course )
                                <tr id={{ $course->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td scope="row">{{ $course->name }}</td>
                                    <td scope="row">{{ $course->place }}</td>
                                    <td scope="row">{{ $course->programm }}</td>
                                    <td scope="row">{{ $course->subject }}</td>
                                    <td scope="row">{{ $course->type }}</td>
                                    <td scope="row">{{ $course->lang }}</td>
                                    <td scope="row">{{ $course->date }}</td>
                                    <td scope="row">{{ $course->certificate_no }}</td>
                                    <td scope="row"><img src="{{ url('/images/'.$course->certificate_picture) }}" alt="Image"/></td>
                                    <td scope="row">{{ $course->year }}</td>
                                    <td scope="row"><button id="del" value="{{ $course->id }}" class="btn btn-danger btn-md" onclick="deletecourse({{ $course->id }})">Жою</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br/>
                <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('reports.courses.insert') }}">Біліктілік курстарын еңгізу</a></button>
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
        jQuery(document).ready(function($) {
            $("#more").click(function() {
                $(this).attr("value")
            });
        });
    </script>
    <script>
        let deletecourse = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/reports/courses/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {'course_id': id},
                    success: status_code => {
                        if (status = 200) {
                            window.location.reload(true);
                        } else {
                            alert("Упс... Қайта көріңіз");
                        }
                    }
                });
            }
        } 
    </script>
    <script>
        function search() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("course_table");
            tr = table.getElementsByTagName("tr");
            
            for (i = 1; i < tr.length; i++) {
                td = tr[i];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection