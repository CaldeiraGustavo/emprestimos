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

    public function returnSimulatedValues($request)
    {
        $instituicoes = $this->adapter->findAll();
        $filteredInstitutions = $this->filterTaxInstitutions($request, $instituicoes);
        return $filteredInstitutions;
    }

    private function filterTaxInstitutions($request, $instituicoes) 
    {
        $aux = [];
        $hasInstituicoes = $hasConvenios = $hasParcela = true;

        foreach($instituicoes as $instituicao) {
            if($request->has('instituicoes')) {
                $hasInstituicoes = in_array($instituicao['instituicao'], $request->get('instituicoes'));
            }

            if($request->has('convenios')) {
                $hasConvenios = in_array($instituicao['convenio'], $request->get('convenios'));
            }

            if($request->has('parcela')) {
                $hasParcela = $instituicao['parcelas'] == $request->get('parcela');
            }

            if($hasInstituicoes && $hasConvenios && $hasParcela) {
                $aux[] = $instituicao;
            }
        }
        return $aux;
    }

    private function formataValores($data) 
    {

    }

    private function calculaParecela($valor, $coeficiente)
    {
        return $valor * $coeficiente;
    }
}