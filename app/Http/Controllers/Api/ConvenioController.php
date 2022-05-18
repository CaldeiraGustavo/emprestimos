<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ConvenioService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class ConvenioController extends Controller
{
    private $service;

    public function __construct(ConvenioService $service)
    {
        $this->service = $service;
    }

    public function show()
    {
        try{
            return response()->json($this->service->findAll(), Response::HTTP_OK);
        }catch(InvalidArgumentException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            return response()->json($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
