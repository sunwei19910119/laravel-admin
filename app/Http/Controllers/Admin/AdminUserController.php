<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminUserRequest;
use App\Models\Admin\Role;
use Auth;
use Illuminate\Http\Request;
use App\Models\Admin\AdminUser;
use App\Utils\ConfigUtils;

class AdminUserController extends BaseController
{

    public function index(Request $request)
    {
        $users = AdminUser::query();
        $username = $request->input('username');
        $email = $request->input('email');
        $mobile= $request->input('mobile');
        if($username){
            $users = $users->where('username', 'LIKE', '%' . $username . '%');
        }
        if($email){
            $users = $users->where('email', 'LIKE', '%' . $email . '%');
        }
        if($mobile){
            $users = $users->where('mobile', 'LIKE',  $mobile . '%');
        }

        $pager = $users->orderBy('id', 'DESC')->paginate(env('PAGE_NUM'));
        return view('admin.admin_user.list', compact('pager'));
    }

    public function show()
    {
        $roles = Role::all();
        return view('admin.admin_user.item', compact('roles'));
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = new AdminUser();
        $item = $user->find($id);
        return view('admin.admin_user.item', compact('roles', 'item'));
    }


    /*
    * 创建用户
    */
    public function store(AdminUserRequest $request, AdminUser $admin_user)
    {
        $admin_user->username = $request->username;
        $admin_user->password = bcrypt($request->password);
        $admin_user->email = $request->email;
        $admin_user->mobile = $request->mobile;
        $admin_user->sex = $request->sex;

        if (!$admin_user->save()) {
            return $this->retJson(503, '操作出错!');
        }
        $roles = $request->input('roles');
        if (!empty($roles)) {
            foreach ($roles as $k => $role) {
                if (empty($role)) unset($roles[$k]);
            }
        }
        $admin_user->saveRoles($roles);
        return $this->retJson(200, '操作成功!');
    }

    public function update(AdminUserRequest $request,AdminUser $admin_user)
    {
        if (ConfigUtils::inConfigIds($admin_user->id, "admin.user_table_cannot_manage_ids", false))
            return $this->retError(403, '该用户禁止修改!');

        $admin_user->username = $request->username;
        $admin_user->email = $request->email;
        $admin_user->mobile = $request->mobile;
        $admin_user->sex = $request->sex;
        if($request->password){
            $admin_user->password = bcrypt($request->password);
        }
        if (!$admin_user->save()) {
            return $this->retJson(503, '操作出错!');
        }
        $roles = $request->input('roles');
        if (!empty($roles)) {
            foreach ($roles as $k => $role) {
                if (empty($role)) unset($roles[$k]);
            }
        }
        $admin_user->saveRoles($roles);
        return $this->retJson(200, '操作成功!');
    }



    public function destroy($id)
    {
        if (ConfigUtils::inConfigIds($id, "admin.user_table_cannot_manage_ids", false))
            return $this->retError(403, '该用户禁止修改!');
        $user = new AdminUser();
        $user->id = $id;
        $user->exists = true;
        if (!$user->delete()) {
            return $this->retJson(503, '操作出错!');
        }
        return $this->retJson(200, '操作成功!');
    }

}
