<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimulacaoRequest extends FormRequest
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
            'valor_emprestimo'  => ['required', 'numeric'],
            'instituicoes'      => ['nullable', 'array'],
            'convenios'         => ['nullable', 'array'],
            'parcela'           => ['nullable', 'numeric'],
        ];
    }

    /**
     * Get the messages that shows after request fails.
     *
     * @return array
     */

    public function messages() 
    {
        return [
            'required' => 'O parâmetro :attribute é obrigatório.',
            'valor_emprestimo.required' => 'O valor do empréstimo é obrigatório',
            'array' => 'O parâmetro :attribute deve ser um array.',
            'numeric' => 'O parâmetro :attribute deve ser um valor numérico.',
        ];
    }
}
