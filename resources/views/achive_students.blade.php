@extends('layouts.app')

@section('content')
    @auth
        <div class="flex justify-center">
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
                                <th scope="col">Тобы </th>
                                <th scope="col">Жетекшісі</th>
                                <th scope="col">Қатысқан іс-шара</th>
                                <th scope="col">Деңгейі </th>
                                <th scope="col">Қатысқан іс-шара атауы </th>
                                <th scope="col">Мерзімі</th>
                                <th scope="col">Марапаты</th>
                                <th scope="col">Әрекет</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($achives as $key => $achive )
                                <tr id={{ $achive->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td scope="row">{{ $achive->name }}</td>
                                    <td scope="row">{{ $achive->groups }}</td>
                                    <td scope="row">{{ $achive->advisor }}</td>
                                    <td scope="row">{{ $achive->shara }}</td>
                                    <td scope="row">{{ $achive->level }}</td>
                                    <td scope="row">{{ $achive->shara_name }}</td>
                                    <td scope="row">{{ $achive->period }}</td>
                                    <td scope="row">{{ $achive->achivement }}</td>
                                    <td scope="row"><button id="del" value="{{ $achive->id }}" class="btn btn-danger btn-md" onclick="deleteachive({{ $achive->id }})">Жою</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br/>
                    <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('student.achives.insert') }}">Студент жетістігін еңгізу</a></button>

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
        let deleteachive = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/achives/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {'achive_id': id},
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

    </script>
@endsection