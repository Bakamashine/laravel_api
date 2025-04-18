<?php

namespace App;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\JsonResponse;

trait ApiHelper
{
    /**
     * Вывывается при удачном стечении обстоятельств
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse|mixed
     */
    function isSuccess($data, string $message = '', int $code = 200)
    {
        return response()->json([
            "status" => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }
    
    function codeAndMessage($message = '', $code = 200) {
        return response()->json([
            "code" => $code,
            "message" => $message,
        ], $code);
    }
    
    function data($data, $code = 201) {
        return response()->json([
            "data" => $data
        ], $code);
    }

    /**
     * Обёртка error
     * @param mixed $data
     * @return JsonResponse|mixed
     */
    function Error($data, $code=200)
    {
        return response()->json(["error" => $data], $code);
    }

    /**
     * Ошибка авторизации
     * @return void
     */
    function LoginFailed()
    {
        $code = 403;
        $this->Error([
            "code" => $code,
            "message" => "Login failed"
        ], $code);
    }

    /**
     * Недостаток прав
     * @return JsonResponse|mixed
     */
    function Forbidden()
    {
        $code = 403;
        return $this->Error(["code" => $code, "message" => "Forbidden for you"], $code);
    }

    /**
     * Ошибки валидации
     * @param mixed $data
     * @param string $message
     * @param mixed $code
     * @return JsonResponse|mixed
     */
    function ValidateError($data, string $message = 'Validation Error', $code = 422)
    {
        return $this->Error([
            "code" => $code,
            "message" => $message,
            "errors" => $data
        ], $code);
    }
}
