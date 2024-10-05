<?php namespace Digitlimit\Adminpanel\Plugins\Post\Http\Requests\Post;

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
            'title.unique'=>'A post with same title already exists',
        ];
    }

    //adding some times
    protected function getValidatorInstance(){
        $validator = parent::getValidatorInstance();

        $validator->after(function($validator){
            $id = $this->route('id');
            if(!is_numeric($id)) $validator->errors()->add('invalid_id', 'Opps seems post no longer exists v');
        });

        return $validator;
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
        $id = $this->route('id');

        return [
            'title' => "required|min:5|unique:adminpanel_plugin_posts,title,{$id}",
            'content' => 'required|min:20',
            'privacy' => 'required',
            'published' => 'required',
            'summary' => 'sometimes|min:10'
        ];
    }
}