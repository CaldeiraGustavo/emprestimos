<?php
namespace App\Http\Adapters\Eloquent;

use App\Http\Adapters\Contracts\TaxaInstituicaoAdapterInterface;

class TaxaInstituicaoAdapter extends BaseAdapter implements TaxaInstituicaoAdapterInterface
{
    public function fileName() 
    {
        return 'taxas_instituicoes.json';
    }
}