<?php

namespace App\Http\Services;

use App\Http\Adapters\Contracts\TaxaInstituicaoAdapterInterface;
use Exception;
use Illuminate\Http\Response;
use InvalidArgumentException;

class TaxaInstituicaoService 
{

    private $adapter;
    public function __construct(TaxaInstituicaoAdapterInterface $adapter)
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