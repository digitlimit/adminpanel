<?php namespace Digitlimit\Adminpanel\Http\Requests\Video;

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
            'title.unique'=>'An event with same title already exists',
            'start_date.date_format'=>'Invalid date format. Date must be in dd-mm-yyyy',
            'end_date.date_format'=>'Invalid date format. Date must be in dd-mm-yyyy',
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
            'title' => 'Video title',
            'privacy' => 'Privacy',
            'youtube' => 'Youtube Video ID'
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
            'title' => "required|unique:adminpanel_videos,title",
            'detail' => 'required|min:20',
            'youtube' => 'required|unique:adminpanel_videos,youtube',
            'privacy' => 'sometimes|min:3' //middleware
        ];
    }
}