<?php
namespace App\Http\Adapters\Eloquent;

use App\Http\Adapters\Contracts\ConvenioAdapterInterface;

class ConvenioAdapter extends BaseAdapter implements ConvenioAdapterInterface
{
    public function fileName() 
    {
        return 'convenios.json';
    }
}