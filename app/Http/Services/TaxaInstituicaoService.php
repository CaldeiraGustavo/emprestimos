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
                if(array_key_exists($instituicao['instituicao'], $aux))                
                    array_push($aux[$instituicao['instituicao']], $this->formataValores($instituicao, $request->get('valor_emprestimo')));
                else
                    $aux[$instituicao['instituicao']] = [$this->formataValores($instituicao, $request->get('valor_emprestimo'))];                
            }
        }
        return $aux;
    }

    private function formataValores($data, $valor) 
    {
        return [
            'taxa'          => $data['taxaJuros'],
            'parcelas'      => $data['parcelas'],
            'valor_parcela' => $this->calculaParecela($valor, $data['coeficiente']),
            'convenio'      => $data['convenio']
        ];
    }

    private function calculaParecela($valor, $coeficiente)
    {
        return number_format($valor * $coeficiente, 2);
    }
}