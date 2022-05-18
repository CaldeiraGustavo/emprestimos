<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class InstituicaoController extends Controller
{
    public function show()
    {
        try{

        }catch(InvalidArgumentException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            return response()->json($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
