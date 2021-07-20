<?php

namespace App\Wallet\Application\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWalletRequest extends FormRequest
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
            'user_id'=>'required|integer',
            'network'=>'required|max:10',
            'address'=>'required|max:255'
        ];
    }
}
