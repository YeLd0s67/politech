@extends('layouts.app')

@section('content')
    <h3 align="center">Оқытушылардың тағлымдамадан өтуі</h3>
    <br/>
    @auth
        <div class="flex justify-center">
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
                                <th scope="col">Тағылымдама өтілу мамандығы</th>
                                <th scope="col">Тағылымдама өтілу орны</th>
                                <th scope="col">Тағылымдама өтілу лауазымы</th>
                                <th scope="col">Тағылымдама өтілу мерзімі</th>
                                <th scope="col">Аяқталу мерзімі</th>
                                <th scope="col">Хаттама №</th>
                                <th scope="col">Куәлік суреті</th>
                                <th scope="col">Әрекет</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($internships as $key => $internship )
                                <tr id={{ $internship->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td scope="row">{{ $internship->name }}</td>
                                    <td scope="row">{{ $internship->prof }}</td>
                                    <td scope="row">{{ $internship->place }}</td>
                                    <td scope="row">{{ $internship->employement }}</td>
                                    <td scope="row">{{ $internship->date }}</td>
                                    <td scope="row">{{ $internship->end_date }}</td>
                                    <td scope="row">{{ $internship->message }}</td>
                                    <td scope="row"><img src="{{ url('/images/'.$internship->pic) }}" alt="Image"/></td>
                                    <td scope="row"><button id="del" value="{{ $internship->id }}" class="btn btn-danger btn-md" onclick="deleteinternship({{ $internship->id }})">Жою</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br/>
                <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('internships.insert') }}">Тағылымдамаларды еңгізу</a></button>
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
                    url: "/second/internships/delete",
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