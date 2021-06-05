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
                                <th scope="col">Топ</th>
                                <th scope="col">Оқуға түскен жылы</th>
                                <th scope="col">Бұйрық</th>
                                <th scope="col">Куратор</th>
                                <th scope="col">Әрекет</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $key => $group )
                                <tr id={{ $group->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td scope="row">{{ $group->group }}</td>
                                    <td scope="row">{{ $group->date }}</td>
                                    <td scope="row">{{ $group->order }}</td>
                                    <td scope="row">{{ $group->advisor }}</td>
                                    <td scope="row"><button id="del" value="{{ $group->id }}" class="btn btn-danger btn-md" onclick="deleteGroup({{ $group->id }})">Жою</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br/>
                <button class="btn btn-primary" type="submit"><a class="text-white" href="{{ route('group.insert') }}">Топ еңгізу</a></button>
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
        let deleteGroup = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/groups/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {'group_id': id},
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