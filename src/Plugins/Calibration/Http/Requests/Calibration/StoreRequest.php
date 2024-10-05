<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Calibration;

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
            'chart_no.unique' => 'The chart no has already been uploaded'
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
            "title" => "Title",
            "truck" => "Truck",
            "client" => "Client",
            "transporter" => "Transporter",
            "chart_no" => "Chart no",
            "chart" => "Chart document upload",
            "expiry_date" => "Chart Expiry date",
            "issued_date" => "Chart Issue date",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { //|mimes:pdf
        return [
//            "title" => "required|min:2|unique:adminpanel_plugin_calibration_charts,title",
            "truck" => "required|numeric|exists:adminpanel_plugin_calibration_trucks,id",
            "client" => "required|numeric|exists:adminpanel_plugin_calibration_clients,id",
            "transporter" => "required|numeric|exists:adminpanel_plugin_calibration_transporters,id",
            "chart_no" => "required|unique:adminpanel_plugin_calibration_charts,chart_no",
            "chart" => "required|mimes:pdf",
            "expiry_date" => "required|date",
            "issued_date" => "required|date",
        ];
    }
}