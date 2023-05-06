<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormParameterRequest extends FormRequest
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
            'id_kriteria' => 'required|exists:kriteria,id',
            'nama' => 'required',
            'bobot' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'id_kriteria.required' => 'Inputan Kriteria harus dipilih',
        ];
    }
}
