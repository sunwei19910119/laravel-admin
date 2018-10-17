<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Response;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Utils\ConfigUtils;

class RoleController extends BaseController
{


    public function index()
    {
        $roles = Role::query();
        $pager = $roles->orderBy('id', 'DESC')->paginate(env('PAGE_NUM'));
        return view('admin.role.list', compact('pager'));
    }

    public function show()
    {
        return view('admin.role.item');
    }

    public function edit($id)
    {
        $role = new Role();
        $item = $role->find($id);
        return view('admin.role.item', compact('item'));
    }

    public function store(RoleRequest $request,Role $role){
        $role->fill($request->only(['name','display_name','description']));
        if (!$role->save()) {
            return $this->retJson(503, '操作出错!');
        }
        return $this->retJson(200, '操作成功!');
    }

    public function update(RoleRequest $request,Role $role){
        if (ConfigUtils::inConfigIds($role->id, "admin.role_table_cannot_manage_ids", false))
            return $this->retError(403, '该角色禁止修改!');
        $role->fill($request->only(['name','display_name','description']));
        if (!$role->save()) {
            return $this->retJson(503, '操作出错!');
        }
        return $this->retJson(200, '操作成功!');
    }


    public function destroy($id)
    {
        if (ConfigUtils::inConfigIds($id, "admin.role_table_cannot_manage_ids", false))
            return $this->retError(403, '该角色禁止修改!');
        $role = new Role();
        $role->id = $id;
        $role->exists = true;
        if (!$role->delete()) {
            return $this->retJson(503, '操作出错!');
        }
        return $this->retJson(200, '操作成功!');
    }

    public function permissionEdit($id)
    {
        $role = new Role();
        $role = $role->find($id);
        $pager = Permission::all();
        return view('admin.role.permission', compact('pager', 'role'));
    }

    public function permissionStore(Request $request, $id)
    {
        try {
            $role = new Role();
            $role = $role->find($id);
            $this->validate($request, [
                'perms' => 'array'
            ]);
            $role->savePermissions($request->get('perms'));
            if (!$role->save()) {
                return $this->retJson(503, '操作出错!');
            }
            return $this->retJson(200, '操作成功!');
        } catch (Exception $e) {
            return $this->retJson(503, '操作出错!');
        }
    }

}
