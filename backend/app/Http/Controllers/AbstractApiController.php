<?php

namespace App\Http\Controllers;

class AbstractApiController extends Controller
{
    protected function apiSuccessResponse(mixed $apiResult, int $status = 200)
    {
        return response()->json($apiResult, $status);
    }

    protected function apiErrorResponse(mixed $errorResult, int $status = 404)
    {
        return response()->json($errorResult, $status);
    }
}