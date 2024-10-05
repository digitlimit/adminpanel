<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Truck;

use App\Http\Requests\Request;

class StoreRequest extends Request
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
     * Set custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * Set custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'reg_number' => 'Truck number',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'model' => "required|min:2|alpha_num",
            'reg_number' => 'required|min:3|unique:adminpanel_plugin_calibration_trucks,reg_number',
            'chassis_number' => 'required|min:2',
            'volume' => 'required|min:2|numeric',
        ];
    }
}