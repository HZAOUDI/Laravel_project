@extends('Layout.nav1')
  
@section('content')
<div class="container">


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="/consulter"> Back</a>
            </div>
        </div>
    </div>
      
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
     
    <form action="{{ route('update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      
         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom:</strong>
                    <input type="text" name="Nom" value="{{ $product->Nom }}" class="form-control" placeholder="Nom">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $product->Description}}</textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Ville:</strong>
                    <select id="input_select2" class="form-control" name="Ville">
                        <option value="tous" {{ $product->Ville == 'tous' ? 'selected' : '' }}>Tous</option>
                        <option value="Casablanca" {{ $product->Ville == 'Casablanca' ? 'selected' : '' }}>Casablanca</option>
                        <option value="Fès" {{ $product->Ville == 'Fès' ? 'selected' : '' }}>Fès</option>
                        <option value="Tangier" {{ $product->Ville == 'Tangier' ? 'selected' : '' }}>Tangier</option>
                        <option value="Marrakech" {{ $product->Ville == 'Marrakech' ? 'selected' : '' }}>Marrakech</option>
                        <option value="Sale" {{ $product->Ville == 'Sale' ? 'selected' : '' }}>Sale</option>
                        <option value="Meknès" {{ $product->Ville == 'Meknès' ? 'selected' : '' }}>Meknès</option>
                        <option value="Agadir" {{ $product->Ville == 'Agadir' ? 'selected' : '' }}>Agadir</option>
                        <option value="Tétouan" {{ $product->Ville == 'Tétouan' ? 'selected' : '' }}>Tétouan</option>
                        <option value="Safi" {{ $product->Ville == 'Safi' ? 'selected' : '' }}>Safi</option>
                    </select>
                </div>
            </div>

            <!--<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Is_Visible:</strong>
                    <input type="text" name="is_visible" value="{{ $product->is_visible }}" class="form-control" placeholder="is_visible">
                </div>
            </div> -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Annonce en ligne ?:</strong>
                    <input type="checkbox" name="is_visible" value="1" {{ $product->is_visible == 1 ? 'checked' : '' }}>
                </div>
            </div>

            <!--
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <input type="text" name="status" value="{{ $product->status }}" class="form-control" placeholder="status">
                </div>
            </div>
            -->
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type:</strong>
                    <select id="myselection" name="type" class="form-control">
                        <option>Select Option</option>
                        <option value="Normale" {{ $product->type == 'Normale' ? 'selected' : '' }}>Normale</option>
                        <option value="Particuliere" {{ $product->type == 'Particuliere' ? 'selected' : '' }}>Particuliere</option>
                    </select>
                </div>
            </div>    

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date_Dispo_Debut:</strong>
                    <input type="date" name="date_dispo_debut" value="{{ $product->date_dispo_debut }}" class="form-control" placeholder="date_dispo_debut">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date_Dispo_Fin:</strong>
                    <input type="date" name="date_dispo_fin" value="{{ $product->date_dispo_fin }}" class="form-control" placeholder="date_dispo_fin">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>NbrMinLocation:</strong>
                    <input type="text" name="Num_jour_min" value="{{ $product->Num_jour_min }}" class="form-control" placeholder="Num_jour_min">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                    <img src="/images/{{ $product->image }}" width="300px">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
      
    </form>

</div>
@endsection