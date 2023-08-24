@extends('Layout.nav1')

@section('title','Contrats')

@section('content')    

    <div class="container">
        <div class="jumbotron">
            <h2>Listes des Contrats</h2>
            <form action="">
                <table class="table table-bordered table-striped" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nº Contrat</th>
                            <th>Nº Partenaire</th>
                            <th>Nº Client</th>
                            <th>Nº Annonce</th>
                            <th>Ajoutée le</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contrat as $row)
                        <tr style="background: white;">
                            <td> {{$row->id}} </td>
                            <td> {{$row->id_partenaire}} </td>
                            <td> {{$row->id_client}} </td>
                            <td> {{$row->id_ann}} </td>
                            <td> {{$row->created_at	}} </td>
                            <td> <a class="btn btn-primary btn-sm" href="click_edit_{{ $row->id }}"> View</a>  
                                <a class="btn btn-warning btn-sm">Exporter pdf</a> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </form>
        </div>
    </div>

@endSection  

<!--@section('scripts')  
<script>
    $(document).ready ( function()  {

        fetchcontrat();

        function fetchcontrat()
        {
            $.ajax({
                type:"GET",
                url: "/fetch-contrat",
                dataType: "json", 
                success: function(response) {
                    $('tbody').html("");  
                    //console.log(response.contrats);
                    $.each(response.contrats, function (key, item) {
                          
                        $('tbody').append ('
                                <tr style="background: white;">\
                                    <td>' + item.id + '</td>\
                                    <td>' + item.id_partenaire + '</td>\
                                    <td>' + item.id_client + '</td>\
                                    <td>' + item.id_ann + '</td>\
                                    <td>' + item.created_at + '</td>\
                                    <td> <button type="button" value="'+item.id+'" class="btn btn-primary btn-sm">View</button> \
                                        <a class="btn btn-warning btn-sm">Exporter pdf</a> \
                                    </td>\
                                 </tr>  '
                            );
                    } );
                }
            });
        }
    });
</script> -->