@extends('layouts.app')

@section('content')
    @auth
        <div class="flex justify-center">
            <div class="form-group">
                <form method="GET" action="{{ route('student.list') }}">
                    {{ csrf_field() }}
                    <label>Курс</label>
                    <select class="form-select" name="course" id="course">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>                            
                    </select>
                    <label>Топ</label>
                    <select class="form-select" name="group" id="group">
                        @foreach ($groups as $group )
                            <option value="{{ $group->group }}">{{$group->group}}</option>                            
                        @endforeach          
                    </select>
                    <br/>
                    <div class="form-group">
                        <div class="col-md-6">
                          <input type="submit" name="download" value='Студенттер тізімі' class='btn btn-success'>
                        </div>
                    </div>
                </form>

            </div>
            <div class="w-8/12 bg-white p-6 rounded-lg">
                <div class="input-group rounded">
                    <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                      aria-describedby="search-addon" />
                </div>
                    <table id="group_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th id="id" scope="col">#</th>
                                <th scope="col">Студенттің аты-жөні</th>
                                <th scope="col">Туылған күні, айы, жылы</th>
                                <th scope="col">Тобы</th>
                                <th scope="col">Курсы</th>
                                <th scope="col">Әрекет</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student )
                                <tr id={{ $student->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td scope="row">{{ $student->name }}</td>
                                    <td scope="row">{{ $student->date_birth }}</td>
                                    <td scope="row">{{ $student->groups }}</td>
                                    <td scope="row">{{ $student->course }}</td>
                                    <td scope="row"><button id="del" value="{{ $student->id }}" class="btn btn-danger btn-md" onclick="deleteStudent({{ $student->id }})">Жою</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $students->links() }}
                    <br/>
                    <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('student.insert') }}">Студент еңгізу</a></button>
                    <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('student.achives') }}">Студент жетістіктері</a></button>

                </div>
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
        let deleteStudent = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/students/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {'student_id': id},
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
            table = document.getElementById("group_table");
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
        // $(document).on('click', '#download',function(){
        //     var course = $('#course').val();
        //     var group = $('#group').val();
        //     $.ajax({
        //         type:'GET',
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url:"{{ route('student.list') }}",
        //         data:{'course':course, 'group':group},
        //         success:function(data){     
        //             window.location = 'students/'+data;                           
        //         }
        //     });
        // });
    </script>
@endsection