@extends('layouts.app')

@section('content')
    <h3 align="center">Оқытушылардың жетістіктері</h3>
    <br/>
    @auth
        <div class="flex justify-center">
            <div class="w-10/12 bg-white p-6 rounded-lg">
                <div class="form-group">
                    <form method="GET" action="{{ route('reports.achivements.list') }}">
                        {{ csrf_field() }}
                        <label>Жылы</label>
                        <input type="text" name="year" id="year" class="form-control" value="" />
                        <div class="col-md-6">
                           <input type="submit" name="download" value='Жүктеу' class='btn btn-success'>
                        </div>
                    </form>
                </div>
                <div class="input-achivement rounded">
                    <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                      aria-describedby="search-addon" />
                </div>
                    <table id="achivement_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th id="id" scope="col">#</th>
                                <th scope="col">Оқытушының аты жөні</th>
                                <th scope="col">Тақырып атауы</th>
                                <th scope="col">Байқау атауы</th>
                                <th scope="col">Өткен жері </th>
                                <th scope="col">Жылы </th>
                                <th scope="col">Байқау деңгейі</th>
                                <th scope="col">Алған орны</th>
                                <th scope="col">Өтілген уақыты </th>
                                <th scope="col">Куәлік </th>
                                <th scope="col">Диплом </th>
                                <th scope="col">Әрекет </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($achivements as $key => $achivement )
                                <tr id={{ $achivement->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td scope="row">{{ $achivement->name }}</td>
                                    <td scope="row">{{ $achivement->topic }}</td>
                                    <td scope="row">{{ $achivement->contest }}</td>
                                    <td scope="row">{{ $achivement->place }}</td>
                                    <td scope="row">{{ $achivement->year }}</td>
                                    <td scope="row">{{ $achivement->level }}</td>
                                    <td scope="row">{{ $achivement->win }}</td>
                                    <td scope="row">{{ $achivement->date }}</td>
                                    <td scope="row">{{ $achivement->id_no }}</td>
                                    <td scope="row"><img src="{{ url('/images/'.$achivement->diplom) }}" alt="Image"/></td>
                                    <td scope="row"><button id="del" value="{{ $achivement->id }}" class="btn btn-danger btn-md" onclick="deleteachivement({{ $achivement->id }})">Жою</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br/>
                <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('reports.achivements.insert') }}">Оқытушылардың жетістіктерін еңгізу</a></button>
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
        let deleteachivement = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/reports/achivements/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {'achivement_id': id},
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
            table = document.getElementById("achivement_table");
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