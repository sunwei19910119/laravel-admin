<?php
namespace App\Models\Admin;

use Config;
use App\Models\Admin\Interfaces\AdminRoleInterface;
use App\Models\Admin\Traits\AdminRoleTrait;
use App\Models\Admin\Model;

class Role extends Model implements AdminRoleInterface
{
    use AdminRoleTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('admin.role_table');
    }

}