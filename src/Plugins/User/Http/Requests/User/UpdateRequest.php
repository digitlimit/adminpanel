<?php namespace Digitlimit\Adminpanel\Plugins\User\Http\Requests\User;

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
            'name' => 'Full name',
            'email' => 'Email address',
            'company' => 'Company'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $email = $this->get('email');

        return [
            'name' => 'required|max:255',
            'email' => "required|email|max:255|unique:users,id,$email",
            'password' => 'sometimes|min:6',
            'company' => 'required|numeric|exists:adminpanel_plugin_calibration_clients,id',
        ];
    }
}