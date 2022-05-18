<?php
namespace App\Http\Adapters\Eloquent;

use App\Http\Adapters\Contracts\InstituicaoAdapterInterface;

class InstituicaoAdapter extends BaseAdapter implements InstituicaoAdapterInterface
{ 
    public function fileName() 
    {
        return 'instituicoes.json';
    }
}