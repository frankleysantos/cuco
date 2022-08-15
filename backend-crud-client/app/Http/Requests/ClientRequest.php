<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ClientRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        if ($request->id)
            return [];
            // if($request->cpf)
            //     return [
            //         'cpf'   => 'required|unique:clients',
            //     ];
            // else
                // return [];

        return [
            'full_name'     => 'required',
            // 'cpf'           => 'required|unique:clients',
            'cpf'           => 'required',
            'birth_date'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required'        => 'O nome completo é obrigatório!',
            'cpf.required'              => 'O CPF é obrigatório!',
            'birth_date.required'       => 'A data de nascimento é obrigatória!',
        ];
    }
}
