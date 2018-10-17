<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model as OriginModel;

abstract class Model extends OriginModel
{
    protected $guarded = array('id');
    protected $perPage = 10;

    public function isNew()
    {
        return !($this->getAttribute($this->primaryKey) > 0);
    }
}