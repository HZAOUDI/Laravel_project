<?php

namespace App\Http\Requests\Annonce;

use App\Models\Annonce;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AnnonceFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        $user_id = Auth::id();
       
        $rules =[
            'Nom' => [
                'required'
            ],
            'Description' => [
                'required'
            ],
            'Categorie' => [
                'required'
            ],
            'Objet' => [
                'required'
            ],
            'Prix' => [
                'required'
            ],
            'Num_jour_min' => [
                ''
            ],
            'Ville' => [
                'required'
            ],
            'type' => [
                'required'
            ],
            'date_dispo_debut' => [
                'required'
            ],
            'date_dispo_fin' => [
                'required'
            ],

            'is_visible' => [
                function ($attribute, $value, $fail) use ($user_id) {
                    $num_checked = Annonce::where('user_id', $user_id)->where('is_visible', '1')->count();
                    if ($value && $num_checked >= 5) {
                        $fail('Vous avez dépasser 5 annones en ligne!! Penser à retirer d)qutres pour ajouter celle-ci  ');
                    }
                },
               
            ],
            

            

        ];
        return $rules;
    
    }
}
