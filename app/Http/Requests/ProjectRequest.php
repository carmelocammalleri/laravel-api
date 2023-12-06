<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            "name" => "required|min:2|max:100",
            "date_creation" => "required",
            "description" => "max:200",
            "type" => "",
            "tecnology" => "max:50",
            "web_site" => "max:200"
            ];
    }
    public function messages(){
        return [
            "name.required" => "Il nome è un campo obbligatorio.",
            "name.min" => "Il nome deve essere lungo almeno :min caratteri.",
            "name.max" => "Il nome deve essere minore di :max caratteri",
            "date_creation.numeric" => "La data deve essere un numero.",
            "description.max" => "La descrizione non deve superare :max caratteri.",
            "type" => "",
            "tecnology.max" => "La Tecnologia non deve superare :max caratteri.",
            "web_site.max" => "La URL non deve superare :max caratteri.",
            ];
    }
}
