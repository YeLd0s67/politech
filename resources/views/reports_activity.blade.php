@extends('layouts.app')

@section('content')
    <h3 align="center">Медиажоспар</h3>
    <br/>
    @auth
        <div class="flex justify-center">
            <div class="w-8/12 bg-white p-6 rounded-lg">
                <div class="input-activity rounded">
                    <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                      aria-describedby="search-addon" />
                </div>
                    <table id="activity_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th id="id" scope="col">#</th>
                                <th scope="col">Оқытушы аты-жөні</th>
                                <th scope="col">Мақала тақырыбы</th>
                                <th scope="col">Орындалу уақыты</th>
                                <th scope="col">Әрекеті</th>
                                <th scope="col">Мақала шыққан баспасы</th>
                                <th scope="col">Әрекет</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $key => $activity )
                                <tr id={{ $activity->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td scope="row">{{ $activity->name }}</td>
                                    <td scope="row">{{ $activity->topic }}</td>
                                    <td scope="row">{{ $activity->date }}</td>
                                    <td scope="row">{{ $activity->status }}</td>
                                    <td scope="row">{{ $activity->edition }}</td>
                                    <td scope="row"><button id="del" value="{{ $activity->id }}" class="btn btn-danger btn-md" onclick="deleteactivity({{ $activity->id }})">Жою</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br/>
                <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('reports.activity.insert') }}">Медиажоспар еңгізу</a></button>
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
        let deleteactivity = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/reports/activity/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {'activity_id': id},
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
            table = document.getElementById("activity_table");
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