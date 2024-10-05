<?php namespace Digitlimit\Adminpanel\Http\Requests\Plugin;

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
        return [
//            'title.unique'=>'A page with same title already exists',
//            'start_date.date_format'=>'Invalid date format. Date must be in dd-mm-yyyy',
//            'end_date.date_format'=>'Invalid date format. Date must be in dd-mm-yyyy',
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
            'plugin' => 'Plugin'
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
            'plugin' => 'mimes:zip|max:1000',
        ];
    }
}