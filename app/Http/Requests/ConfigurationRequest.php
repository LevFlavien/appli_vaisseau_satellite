<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Configuration;

class ConfigurationRequest extends FormRequest
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
            'amiral_address' => 'max:15'
        ];
    }

    public function save() {

        $configuration = Configuration::all()->first();

        if ($configuration) {
            $configuration->fill(request()->all());
            $configuration->save();
        } else {
            Configuration::create(request()->all());
        }
    }
}
