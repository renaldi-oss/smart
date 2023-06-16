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
            'parameter_id.*' => 'required|exists:parameter,id',
            // 'nilai.*' => 'required',
            'alternatif_id' => 'required'            
        ];
    }

    public function messages()
    {
        $messages = [];
        $kriteria = Kriteria::all();
        foreach ($this->get('parameter_id') as $key => $value) {
            $messages['parameter_id.'.$key.'.required'] = 'Inputan '.$kriteria[$key-1]->nama.' harus dipilih';
        }

        return $messages;
    }
}
