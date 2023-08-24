<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
        $rules = [

            'image' => [
                'nullable'
            ],
            
            'Nom' => [
                'required',
                'string'
            ],

            'Description' => [
                'required'
            ],

            'Marque' => [
                'required',
                'string'
            ],

            'Categorie'=>[
                'required'

            ],

            'Objet'=>[
                'required'
            ],
            

            'Prix'=>[
                'required'

            ],

            'Num_jour_min'=>[
                'required'
            ],

            'Ville'=>[
                'required'
            ],

            'date_dispo_debut'=>[
                'required'
            ],

            'date_dispo_fin'=>[
                'required'
            ],

            'status'=>[
                'nullable'
            ],
            
            
        ];

        return  $rules;

    }
}
