<?php
namespace App\Models\Admin;

use App\Models\Admin\Interfaces\AdminMenuInterface;
use App\Models\Admin\Traits\AdminMenuTrait;
use App\Models\Admin\Model;

class Menu extends Model implements AdminMenuInterface
{
    use AdminMenuTrait;

    protected $table;

    protected $primaryKey = 'id';

    protected static $branchOrder = [];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('admin.menu_table');
    }

}
