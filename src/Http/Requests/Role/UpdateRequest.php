<?php namespace Digitlimit\Adminpanel\Http\Requests\User;

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
        return [

        ];
    }

    /**
     * Set custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'role name',
            'display_name' => 'display name',
            'description' => 'description'
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
            'name' => "required|min:5|alpha_dash|unique:roles,name",
            'display_name' => 'required|min:20',
            'description' => 'sometimes|min:10'
        ];
    }
}