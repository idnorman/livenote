<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{
    protected $code = 200;
    //untuk memberikan laporan error, (bisa melalui notifikasi email atau apalah)
    public function report(){

    }

    public function render($request){
        return new JsonResponse([
            'errors' => [
                'message' => $this->getMessage()
            ],
        ], $this->code);
    }
}
