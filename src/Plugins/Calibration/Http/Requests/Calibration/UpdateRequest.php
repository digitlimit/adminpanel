<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Calibration;

use App\Http\Requests\Request;

class UpdateRequest extends Request
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
            'name' => 'page title',
            'detail' => 'Client information'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');

        return [
            'name' => "required|min:2|unique:adminpanel_plugin_calibration_clients,name,$id",
            'detail' => 'required|min:20'
        ];
    }
}