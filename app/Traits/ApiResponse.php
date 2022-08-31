<?php
namespace App\Traits;
trait ApiResponse{
    protected function successResponse($data,$code)
    {
        return response()->json(["data" => $data, "status" => $code], $code);
    }
    protected function errorResponse($errors=[],$code,$message)
    {
        if ($errors) {
            return response()->json(
                ["message" => $message, "errors" => $errors, "status" => $code],
                $code
            );
        }
        return response()->json(
            ["message" => $message, "status" => $code],
            $code
        );
    }
}
?>
