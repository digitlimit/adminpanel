<?php namespace Digitlimit\Adminpanel\Http\Requests\Auth;

use App\Http\Requests\Request;

class AuthLoginRequest extends Request
{

	/**
	 * The route to redirect to if validation fails.
	 *
	 * @var string
	 */
	protected $redirectRoute = 'adminpanel.auth.getLogin';


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
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email' => 'required|email',
			'password' => 'required'
		];
	}
}