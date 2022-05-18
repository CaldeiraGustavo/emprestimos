<?php
namespace App\Http\Adapters\Eloquent;

abstract class BaseAdapter
{
    protected $model;

    abstract function fileName();

    public function __construct()
    {
        $this->returnJson();
    }

    public function returnJson() 
    {
        return json_decode(file_get_contents(public_path() . "\\info\\" . $this->fileName()), true);
    }

    public function findAll() 
    {
        return $this->returnJson();
    }
}