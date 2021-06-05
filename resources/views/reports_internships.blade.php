@extends('layouts.app')

@section('content')
    <h3 align="center">Тағылымдамалар</h3>
    <br/>
    @auth
        <div class="flex justify-center">
            <div class="form-group">
                <form method="GET" action="{{ route('reports.internships.list') }}">
                    {{ csrf_field() }}
                    <label>Жылы</label>
                    <input type="text" name="year" id="year" class="form-control" value="" />
                    <div class="col-md-6">
                       <input type="submit" name="download" value='Жүктеу' class='btn btn-success'>
                    </div>
                </form>
            </div>
            <div class="w-8/12 bg-white p-6 rounded-lg">
                <div class="input-internship rounded">
                    <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                      aria-describedby="search-addon" />
                </div>
                    <table id="internship_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th id="id" scope="col">#</th>
                                <th scope="col">Педагогтің тегі, аты, әкесінің аты</th>
                                <th scope="col">Қызметі</th>
                                <th scope="col">Тағылымдамадан өткен лауазымы</th>
                                <th scope="col">Алған біліктілігі</th>
                                <th scope="col">Хаттама</th>
                                <th scope="col">Жылы</th>
                                <th scope="col">Тағылымдама өтілу орны </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($internships as $key => $internship )
                                <tr id={{ $internship->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td scope="row">{{ $internship->name }}</td>
                                    <td scope="row">{{ $internship->service }}</td>
                                    <td scope="row">{{ $internship->post }}</td>
                                    <td scope="row">{{ $internship->edu_received }}</td>
                                    <td scope="row">{{ $internship->message }}</td>
                                    <td scope="row">{{ $internship->date }}</td>
                                    <td scope="row">{{ $internship->place }}</td>
                                    <td scope="row"><button id="del" value="{{ $internship->id }}" class="btn btn-danger btn-md" onclick="deleteinternship({{ $internship->id }})">Жою</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br/>
                <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('reports.internships.insert') }}">Тағылымдамаларды еңгізу</a></button>
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
        let deleteinternship = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/reports/internships/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {'internship_id': id},
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
            table = document.getElementById("internship_table");
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