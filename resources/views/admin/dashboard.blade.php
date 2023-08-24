@extends('layouts.master')

@section('title', 'RentAppDashboard')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Espace Admin / Tableau de bord</li>
    </ol>
    <div class="row">

        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Total Categories
                    <h4> {{ $categories }} </h4>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('admin/category') }}">Voir Details</a> 
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    Total Utilisateurs
                    <h4> {{ $users }} </h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('admin/users') }}">Voir Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Total Annonces
                    <h4>5</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Voir Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    Total Admins
                    <h4> {{ $admins }} </h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('admin/users') }}">Voir Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Nombre d'utilisateurs Inscrits/Mois 
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Nombre des Annonces Ajoutées/Mois 
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>

    <div class="row">
        <!--<div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Bar Chart Example
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>-->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Nbr des Annoces/Categories
                </div>
                <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
            </div>
        </div>
    </div>
    
</div>

@endsection 

@push('scripts')
    <script type="text/javascript">
        var _ydata=JSON.parse('{!! json_encode($months) !!}'); 
        var _xdata=JSON.parse('{!! json_encode($mothCount) !!}');  

        var _vdata=JSON.parse('{!! json_encode($categoryLabels) !!}'); 
        var _udata=JSON.parse('{!! json_encode($categoryCounts) !!}'); 

        var _bdata=JSON.parse('{!! json_encode($months2) !!}'); 
        var _adata=JSON.parse('{!! json_encode($mothCount2) !!}');  


    </script>
@endpush