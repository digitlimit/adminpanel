<?php namespace Digitlimit\Adminpanel\Http\Requests\Page;

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
//            'title.unique'=>'A video with same title already exists',
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
            'title' => 'page title',
            'privacy' => 'privacy',
            'published' => 'status',
            'content' => 'page content',
            'template' => 'template',
            'main_image' => 'banner image',
            'meta_keywords' => 'keywords',
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
            'title' => "required|min:5|unique:adminpanel_pages,title,{$id}",
            'content' => 'required|min:20',
            'privacy' => 'required',
            'published' => 'required',

            'summary' => 'sometimes|min:10',
            'template' => 'sometimes', //|alpha_dash dot
            'main_image' => 'sometimes|mimes:jpeg,bmp,png|min:80',
            'meta_keywords' =>'sometimes|min:3,max:15', //alpha_num| comma
            'published_date'=> 'sometimes|date'
        ];
    }
}