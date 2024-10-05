<?php namespace Digitlimit\Adminpanel\Plugins\Post\Http\Requests\Post;

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
            'title' => 'post title',
            'privacy' => 'privacy',
            'published' => 'post status',
            'content' => 'post content'
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
            'title' => "required|min:5|unique:adminpanel_plugin_posts,title",
            'content' => 'required|min:20',
            'privacy' => 'required',
            'published' => 'required',
            'summary' => 'sometimes|min:10',
        ];
    }
}