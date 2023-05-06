<?php

namespace App\Http\Requests;

use App\Models\Kriteria;
use Illuminate\Foundation\Http\FormRequest;

class FormNilaiRequest extends FormRequest
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
        return [
            'id_parameter.*' => 'required|exists:parameter,id',
        ];
    }

    public function messages()
    {
        $messages = [];
        $kriteria = Kriteria::all();
        foreach ($this->get('id_parameter') as $key => $value) {
            $messages['id_parameter.'.$key.'.required'] = 'Inputan '.$kriteria[$key-1]->nama.' harus dipilih';
        }

        return $messages;
    }
}
