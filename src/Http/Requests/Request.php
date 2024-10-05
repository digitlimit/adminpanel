<?php namespace Digitlimit\Adminpanel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\ValidationFailedException;

abstract class Request extends FormRequest
{
    /**
     * Added by Emeka Mbah to override
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        return response()->formError($errors, $this->validator);
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        $this->validator = $validator;
        return $validator->getMessageBag()->toArray();
    }

}
