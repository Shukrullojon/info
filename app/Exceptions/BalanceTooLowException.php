<?php

namespace App\Exceptions;

use Exception;

class BalanceTooLowException extends Exception
{
    public function render($request){
        return response()->json([
            "error" => "Sizning balansingizda yetarli mablag' mavjud emas!",
        ], 404);
    }
}
