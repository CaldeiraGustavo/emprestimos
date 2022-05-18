<?php

namespace App\Http\Services;

use App\Http\Adapters\Contracts\InstituicaoAdapterInterface;
use Exception;
use Illuminate\Http\Response;
use InvalidArgumentException;

class InstituicaoService 
{
    private $adapter;
    public function __construct(InstituicaoAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function findAll()
    {
        try{
            return $this->adapter->findAll();
        }catch(Exception $th){
            throw new Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}