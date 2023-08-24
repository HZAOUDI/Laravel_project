
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Add the following line to include TailwindCSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.17/tailwind.min.css">
    <style>
        .myDiv{
            display:none;
            padding:10px;
            margin-top:20px;
        }  
        #showOne{
            border:1px solid red;
        }
        #showNormale{
            border:1px solid green;
        }
        #showParticuliere{
            border:1px solid blue;
        }
        </style> 
    
</head>
<body>
    <form action="/success" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto mt-10">
        @csrf
        <div class="mb-4">
            <label for="Nom" class="block text-gray-700 font-bold mb-2">Titre d'annonce</label>
            <input type="text" id="Nom" name="Nom" class="border border-gray-400 p-2 w-full rounded-md">
        </div>
        <div class="mb-4">
            <label for="Description" class="block text-gray-700 font-bold mb-2">Object</label>
           <select name="objet" id="annonce-type" class="border border-gray-400 p-2 w-full rounded-md">
            @foreach ($objets as $objet)
            <option value="{{$objet->id}}">{{$objet->Nom}}</option>
            @endforeach
           </select>
        </div>
        <div class="mb-4">
            <label for="Description" class="block text-gray-700 font-bold mb-2">Description</label>
            <input type="text" id="Description" name="Description" class="border border-gray-400 p-2 w-full rounded-md">
        </div>
        <div class="mb-4">
            <label for="Prix" class="block text-gray-700 font-bold mb-2">Prix</label>
            <input type="text" id="Prix" name="Prix" class="border border-gray-400 p-2 w-full rounded-md">
        </div>
        <div class="mb-4">
            <label for="Categorie" class="block text-gray-700 font-bold mb-2">Categorie</label>
            <input type="text" id="Categorie" name="Categorie" class="border border-gray-400 p-2 w-full rounded-md">
        </div>
        <div class="mb-4">
            <label for="Ville" class="block text-gray-700 font-bold mb-2">Ville</label>
            <input type="text" id="Ville" name="Ville" class="border border-gray-400 p-2 w-full rounded-md">
        </div>

        <select id="myselection" name="type">
            <option>Select Option</option>
            <option value="Normale">Normale</option>
            <option value="Particuliere">Particuliere</option>
        </select>
        <br>
        <div id="showNormale" class="myDiv">
            <div class="mb-4">
                <label for="Categorie" class="block text-gray-700 font-bold mb-2">Nombre du Jours Minimum</label>
                <input type="text" id="Categorie" name="Num_jour_min" class="border border-gray-400 p-2 w-full rounded-md">
            </div>
            <div class="mb-4">
                <label for="Categorie" class="block text-gray-700 font-bold mb-2">Date Debut</label>
                <input type="date" id="" name="date_dispo_debut" class="border border-gray-400 p-2 w-full rounded-md">
            </div>
            <div class="mb-4">
                <label for="Categorie" class="block text-gray-700 font-bold mb-2">Date Fin</label>
                <input type="date" id="" name="date_dispo_fin" class="border border-gray-400 p-2 w-full rounded-md">
            </div>
        </div>
        <div id="showParticuliere" class="myDiv">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                    disponibilite :
                </label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="disponibilite[]" value="monday">
                    <label class="form-check-label">Lundi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="disponibilite[]" value="tuesday">
                    <label class="form-check-label">Mardi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="disponibilite[]" value="wednesday">
                    <label class="form-check-label">Mercredi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="disponibilite[]" value="thursday">
                    <label class="form-check-label">Jeudi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="disponibilite[]" value="friday">
                    <label class="form-check-label">Vendredi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="disponibilite[]" value="saturday">
                    <label class="form-check-label">Samedi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="disponibilite[]" value="sunday">
                    <label class="form-check-label">Demanche</label>
                </div>
                <label class="form-check-label">Mois:</label>
                <select id="" name="mois">
                    <option>Select Option</option>
                    <option value="Janvier">Janvier</option>
                    <option value="Février">Février</option>
                    <option value="Mars">Mars</option>
                    <option value="Avril">Avril</option>
                    <option value="Mai">Mai</option>
                    <option value="Juin">Juin</option>
                    <option value="Juillet">Juillet</option>
                    <option value="Août">Août</option>
                    <option value="Septembre">Septembre</option>
                    <option value="Octobre">Octobre</option>
                    <option value="Novembre">Novembre</option>
                    <option value="Décembre">Décembre</option>
                </select>                
            </div>
        </div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>      

<script>
$(document).ready(function(){
    $('#myselection').on('change', function(){
    	var demovalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
</script> 
<br>
        <div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Ajouter</button>
        </div>
    </form>
</body>
</html>
