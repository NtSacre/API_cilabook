<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateProjetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            "titre" => ['required','string','min:2'],
            "description" => ['required','string','min:5'],
            "statut" => ['required'],
            "image" => ['required', 'image'],
            "categorie_id" => ['required'],
            
        ];
    }
    
    public function messages()
    {
        return [
            "titre.required" => 'Le titre est requis',
            "titre.regex" => 'Le titre doit être composé de lettres, de chiffres et d\'espaces (au moins 2 caractères)',
            "description.required" => 'La description est requise',
            "description.regex" => 'La description doit être composée de lettres, de chiffres et d\'espaces (au moins 5 caractères)',
            "statut.required" => 'Le statut est requis',
            "image.required" => 'L\'image est requise',
            "categorie_id.required" => 'La catégorie est requise',
            
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
    
        throw new HttpResponseException(response()->json([
            'errors' => $errors,
        ], 422));
    }
}
