@extends('layouts.app')

@section('content')
    <h3 align="center">Оқытушылардың сандық және сапалық құрамы</h3>
    <br/>
    @auth
        <div class="flex justify-center">
            <div class="form-group">
                <form method="GET" action="{{ route('reports.structure.list') }}">
                    {{ csrf_field() }}
                    <label>Санаты</label>
                    <select class="form-select" name="sanat" id="sanat">
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
                    <br/>
                    <div class="form-group">
                        <div class="col-md-6">
                          <input type="submit" name="download" value='Оқытушылардың Тізімі' class='btn btn-success'>
                        </div>
                    </div>
                </form>
    
            </div>
            <div class="w-8/12 bg-white p-6 rounded-lg">
                <div class="input-report rounded">
                    <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                      aria-describedby="search-addon" />
                </div>
                    <table id="report_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th id="id" scope="col">#</th>
                                <th scope="col">Оқытушының аты жөні</th>
                                <th scope="col">Санаты</th>
                                <th scope="col">Санаты берілген уақыты</th>
                                <th scope="col">Санаты аяқталған уақыты</th>
                                <th scope="col">Куәлік номері № </th>
                                <th scope="col">Куәлік суреті</th>
                                <th scope="col">Ғылыми дәрежесі</th>
                                <th scope="col">Әрекет</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $key => $report )
                                <tr id={{ $report->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td scope="row">{{ $report->name }}</td>
                                    <td scope="row">{{ $report->sanat }}</td>
                                    <td scope="row">{{ $report->sanat_start_date }}</td>
                                    <td scope="row">{{ $report->sanat_end_date }}</td>
                                    <td scope="row">{{ $report->certificate_no }}</td>
                                    <td scope="row"><img src="{{ url('/images/'.$report->certificate_picture) }}" alt="Image"/></td>
                                    <td scope="row">{{ $report->dareje }}</td>
                                    <td scope="row"><button id="del" value="{{ $report->id }}" class="btn btn-danger btn-md" onclick="deletereport({{ $report->id }})">Жою</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br/>
                <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('reports.structure.insert') }}">Оқытушылардың сандық және сапалық құрамын енгізу</a></button>
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
        let deletereport = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/reports/structure/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {'report_id': id},
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
            table = document.getElementById("report_table");
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