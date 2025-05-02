<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacturaStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'metodo_pago' => 'required|string|in:Nequi,Daviplata,Paypal',
            'tipo_accion' => 'required|string|in:separar,comprar'
        ];
    }

    public function messages()
    {
        return [
            'metodo_pago.required' => 'El método de pago es obligatorio.',
            'metodo_pago.in' => 'El método de pago seleccionado no es válido.',
            'tipo_accion.required' => 'El tipo de acción es obligatorio.',
            'tipo_accion.in' => 'El tipo de acción seleccionado no es válido.',
        ];
    }
}
