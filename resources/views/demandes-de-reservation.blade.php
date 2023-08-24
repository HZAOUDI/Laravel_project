@extends('Layout.nav1')

@section('title','Acceuil')

@section('content')


<div class="container">
    <div class="section">
        <h1>Demandes de réservation</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date_Debut_Location</th>
                    <th>Date_Fin_Location</th>
                    <th>Id_partenaire</th>
                    <th>Id_client</th>
                    <th>Jours</th>
                    <th>Mois</th>
                    <th>Status</th>
                    <th>Id_annonce</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($_locations as $location)
                    <tr>
                        <td>{{ $location->id }}</td>
                        <td>{{ $location->date_debut_loc}}</td>
                        <td>{{ $location->date_fin_loc}}</td>
                        <td>{{ $location->id_part}}</td>
                        <td>{{ $location->id_client}}</td>
                        <td>{{ $location->Jours }}</td>
                        <td>{{ $location->Mois }}</td>
                        <td>{{ $location->status}}</td>
                        <td>{{ $location->id_annonce}}</td>
                        <td>
                        @if($location->id_part == auth()->id())
                    @if ($location->status == 'en attente')
                        <form method="POST" action="{{ route('locations.confirm', ['id' => $location->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Confirmer</button>
                        </form>
                        <form method="POST" action="{{ route('locations.refuse', ['id' => $location->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Refuser</button>
                        </form>
                    @endif
                    @elseif($location->id_client == auth()->id())
                       <p>Non autorisé</p>
                    @endif
                </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection