<?php

namespace App\Http\Request\Avatar;

use App\Http\Request\BaseRequest;

class AvatarRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'equiped_hair' => 'required',
            'equiped_headgear' => 'required',
            'equiped_top' => 'required',
            'equiped_bottom' => 'required',
            'equiped_shoe' => 'required',
            'equiped_hand' => 'required',
            'equiped_BG' => 'required',
        ];
    }
}
