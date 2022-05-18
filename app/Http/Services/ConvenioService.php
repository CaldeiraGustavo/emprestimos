<?php

namespace App\Http\Services;

use App\Http\Adapter\Contracts\ConvenioAdapterInterface;
use Exception;
use Illuminate\Http\Response;
use InvalidArgumentException;

class ConvenioService 
{
    private $adapter;
    public function __construct(ConvenioAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function findAll()
    {
        try{
            
        }catch(Exception $th){
            throw new Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}