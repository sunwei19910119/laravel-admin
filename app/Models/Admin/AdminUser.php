<?php
namespace App\Models\Admin;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Admin\Interfaces\AdminUserInterface;
use App\Models\Admin\Traits\AdminUserTrait;
use App\Models\Admin\Model;

class AdminUser extends Model implements AuthenticatableContract, CanResetPasswordContract, AdminUserInterface
{
    use Authenticatable, CanResetPassword, AdminUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'mobile', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * User information
     * @var array
     */
    protected $userInfo;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('admin.user_table');
    }

    public function getInfo()
    {
        if ($this->userInfo != null) {
            return $this->userInfo;
        }
        $this->userInfo = $this->getArrayableAttributes();
        return $this->userInfo;
    }

}
