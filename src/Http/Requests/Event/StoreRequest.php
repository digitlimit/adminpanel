<?php namespace Digitlimit\Adminpanel\Http\Requests\Event;

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
            'title' => 'Event title'
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
            'title' => 'required|unique:adminpanel_events,title',
            'venue' => 'required',
            'start_date' => 'required|date_format:d-m-Y',
            'start_time' => 'required',
            'end_date' => 'required|date_format:d-m-Y',
            'end_time' => 'required',
            'detail' => 'required|min:20'
        ];
    }
}