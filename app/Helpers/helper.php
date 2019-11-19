<?php
/**
 * Created by PhpStorm.
 * User: dulmi_j
 * Date: 6/7/2019
 * Time: 12:11 PM
 */

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

/**
 * @category Libraries
 * @package App\Libraries\v1
 * @author Dulmi Jayathilaka <dulmi.j@eyepax.com>
 */
class Helper
{
    /**
     * Get response data
     *
     * @param array $data Data
     * @param string $message Message
     * @param bool $isSuccess Is success
     *
     * @return array
     */
    function getResponseData($data, $message, $isSuccess = true)
    {
        $message = $message ? $message : trans('response.default_message');
        return [
            'success' => $isSuccess,
            'message'     => $message,
            'data'    => $data
        ];
    }

    /**
     * Get return data
     *
     * @param array $data Data
     * @param string $message Message
     * @param bool $isSuccess Is success
     * @param bool $notFound Not found
     * @param bool $notAuthorized Not authorized
     * @param bool $noContent No content
     *
     * @return array|mixed
     */
    public function getReturnData($data, $message, $isSuccess = true, $notFound = false, $notAuthorized = false, $noContent = false)
    {
        $message = $message ? $message : trans('system.default_return_data_message');
        return [
            'success' => $isSuccess,
            'message' => $message,
            'data' => $data,
            'notFound' => $notFound,
            'notAuthorized' => $notAuthorized,
            'noContent' => $noContent
        ];
    }

    /**
     * Return system default response
     *
     * @param array $data Data
     * @param null $message Message
     * @param bool $isSuccess Is success
     * @param int $statusCode Status code
     * @param array $headers Response Headers
     * @param null $options JSON_UNESCAPED_SLASHES
     * @return mixed|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function response($data, $message = null, $isSuccess = true, $statusCode = 200, $headers = [], $options = null)
    {
        $responseData = $this->getResponseData($data, $message, $isSuccess);
        return response()->json($responseData, $statusCode, $headers, $options);
    }

}
