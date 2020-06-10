<?php
/**
 * GoalRequest Request
 *
 * @file      GoalRequest.php
 * @class     GoalRequest
 * PHP Version 7.2
 * @date      07/16/2019 10:26 AM
 * @copyright Copyright Eyepax IT Consulting (Pvt) Ltd.
 */

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request
 *
 * @package  App\Http\Requests
 * @category Requests
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
class HotelRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /*TODO : Need to add rule hear */
        ];
    }
}
