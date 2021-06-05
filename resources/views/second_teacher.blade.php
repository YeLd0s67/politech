@extends('layouts.app')

@section('content')
    <h3 align="center">Оқытушылар туралы мәлімет</h3>
    <br/>    
    @auth
        <div class="flex justify-center">
            <div class="w-8/12 bg-white p-6 rounded-lg">
                <div class="input-group rounded">
                    <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                      aria-describedby="search-addon" />
                </div>
                    <table id="teach_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th id="id" scope="col">#</th>
                                <th scope="col">ЖСН</th>
                                <th scope="col">Аты</th>
                                <th scope="col">Тегі</th>
                                <th scope="col">Әкесі аты</th>
                                <th scope="col">Туған күні</th>
                                <th scope="col">Жынысы</th>
                                <th scope="col">Азаматтығы</th>
                                <th scope="col">Әрекет</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $key => $teacher )
                                <tr id={{ $teacher->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td id="IIN" scope="row">{{ $teacher->iin }}</td>
                                    <td scope="row">{{ $teacher->first_name }}</td>
                                    <td scope="row">{{ $teacher->last_name }}</td>
                                    <td scope="row">{{ $teacher->middle_name }}</td>
                                    <td scope="row">{{ $teacher->date_birth }}</td>
                                    <td scope="row">{{ $teacher->gender }}</td>
                                    @if ($teacher->citizen == 'Басқа')
                                        <td scope="row">{{ $teacher->other_citizen }}</td>
                                    @else 
                                        <td scope="row">{{ $teacher->citizen }}</td>
                                    @endif
                                
                                    <td scope="row"> 
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <button id="more" value="{{ $teacher->id }}" class="btn btn-primary btn-md"><a href='{{ route('second.view.teacher', ['id' => $teacher->id ]) }}' class="text-white">Көру</a></button>
                                                <button id="del" value="{{ $teacher->id }}" class="btn btn-danger btn-md" onclick="deleteTeacher({{ $teacher->id }})">Жою</button>
                                             </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br/>
                <button class="btn btn-primary">
                    <a style="color: white" href="teacher/insert_teacher">Оқытушыны қосу</a>
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
        jQuery(document).ready(function($) {
            $("#more").click(function() {
                $(this).attr("value")
            });
        });
    </script>
    <script>
        let deleteTeacher = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/second/teacher/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {teacher_id: id},
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
            table = document.getElementById("teach_table");
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