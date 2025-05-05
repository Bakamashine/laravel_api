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
    public function isSuccess($data, string $message = '', int $code = 200)
    {
        return response()->json([
            "status" => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }
    
    /**
     * Текст и код
     * @param mixed $message
     * @param mixed $code
     * @return JsonResponse|mixed
     */
    public function codeAndMessage($message = '', $code = 200) {
        return response()->json([
            "code" => $code,
            "message" => $message,
        ], $code);
    }
    
    /**
     * Обёртка data
     * @param mixed $data
     * @param mixed $code
     * @return JsonResponse|mixed
     */
    public function data($data, $code = 201) {
        return response()->json([
            "data" => $data
        ], $code);
    }

    /**
     * Обёртка error
     * @param mixed $data
     * @return JsonResponse|mixed
     */
    public function Error($data, $code=500)
    {
        return response()->json(["error" => $data], $code);
    }

    /**
     * Ошибка авторизации
     * @return void
     */
    public function LoginFailed()
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
    public function Forbidden(string $message = "Forbidden for you")
    {
        $code = 403;
        return $this->Error(["code" => $code, "message" => $message], $code);
    }

    /**
     * Ошибки валидации
     * @param mixed $data
     * @param string $message
     * @param mixed $code
     * @return JsonResponse|mixed
     */
    public function ValidateError($data, string $message = 'Validation Error', $code = 422)
    {
        return $this->Error([
            "code" => $code,
            "message" => $message,
            "errors" => $data
        ], $code);
    }
    
    public function NotFound() {
        return $this->Error([
            "message" => "Not Found"
        ], 404);
    }
}
