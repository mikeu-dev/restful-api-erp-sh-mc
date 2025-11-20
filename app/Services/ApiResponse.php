<?php

namespace App\Services;

class ApiResponse
{
    // 200 OK
    public function success($data = null, string $message = 'Success')
    {
        return $this->respond($data, $message, 200);
    }

    // 201 Created
    public function created($data = null, string $message = 'Created Successfully')
    {
        return $this->respond($data, $message, 201);
    }

    // 204 No Content
    public function noContent(string $message = 'No Content')
    {
        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => $message
        ], 204);
    }

    // 400 Bad Request
    public function badRequest(string $message = 'Bad Request', $data = null)
    {
        return $this->respondError($message, 400, $data);
    }

    // 401 Unauthorized
    public function unauthorized(string $message = 'Unauthorized', $data = null)
    {
        return $this->respondError($message, 401, $data);
    }

    // 403 Forbidden
    public function forbidden(string $message = 'Forbidden', $data = null)
    {
        return $this->respondError($message, 403, $data);
    }

    // 404 Not Found
    public function notFound(string $message = 'Not Found', $data = null)
    {
        return $this->respondError($message, 404, $data);
    }

    // 422 Unprocessable Entity (validasi gagal)
    public function validationFailed($errors, string $message = 'Validation Failed')
    {
        return $this->respondError($message, 422, $errors);
    }

    // 500 Internal Server Error
    public function serverError(string $message = 'Internal Server Error', $data = null)
    {
        return $this->respondError($message, 500, $data);
    }

    // helper private untuk sukses
    private function respond($data, string $message, int $code)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message
        ], $code);
    }

    // helper private untuk error
    private function respondError(string $message, int $code, $data = null)
    {
        return response()->json([
            'status' => 'error',
            'data' => $data,
            'message' => $message
        ], $code);
    }
}
