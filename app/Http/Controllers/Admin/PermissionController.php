<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Exception, Response;
use App\Models\Admin\Permission;
use App\Models\Admin\Menu;
use App\Models\Admin\Role;
use Auth;
use App\Utils\ConfigUtils;

class PermissionController extends BaseController
{

    public function index()
    {
        $permissions = Permission::query();
        $pager = $permissions->orderBy('id', 'DESC')->paginate(env('PAGE_NUM'));
        return view('admin.permission.list', compact('pager'));
    }

    public function show()
    {
        $roles = Role::all();
        $menus = Menu::toTree();
        return view('admin.permission.item', compact('roles' ,'menus'));
    }

    public function edit($id)
    {
        $permission = new Permission();
        $item = $permission->find($id);
        $roles = Role::all();
        $menus = Menu::toTree();
        return view('admin.permission.item', compact('item', 'roles' ,'menus'));
    }

    public function store(PermissionRequest $request,Permission $permission){
        $permission->fill($request->only(['name','display_name','description','controllers']));
        if (!$permission->save()) {
            return $this->retJson(503, '操作出错!');
        }
        //role
        $roles = $request->get('roles');
        if (!empty($roles)) {
            foreach ($roles as $k => $role) {
                if (empty($role)) unset($roles[$k]);
            }
        }
        $permission->saveRoles($roles);
        //menu
        $menu =  $request->get('menus');
        $menus = [];
        if ($menu == 0) {
            $menus = [];
        } else {
            $menus[] = $menu;
        }
        $permission->saveMenus($menus);
        return $this->retJson(200, '操作成功!');
    }

    public function update(PermissionRequest $request,Permission $permission){
        if (ConfigUtils::inConfigIds($permission->id, "admin.permission_table_cannot_manage_ids", false))
            return $this->retError(403, '该权限禁止修改!');
        $permission->fill($request->only(['name','display_name','description','controllers']));
        if (!$permission->save()) {
            return $this->retJson(503, '操作出错!');
        }
        //role
        $roles = $request->get('roles');
        if (!empty($roles)) {
            foreach ($roles as $k => $role) {
                if (empty($role)) unset($roles[$k]);
            }
        }
        $permission->saveRoles($roles);
        //menu
        $menu =  $request->get('menus');
        $menus = [];
        if ($menu == 0) {
            $menus = [];
        } else {
            $menus[] = $menu;
        }
        $permission->saveMenus($menus);
        return $this->retJson(200, '操作成功!');
    }


    public function destroy($id)
    {
        if (ConfigUtils::inConfigIds($id, "admin.permission_table_cannot_manage_ids", false))
            return $this->retError(403, '该权限禁止修改!');
        $permission = new Permission();
        $permission->id = $id;
        $permission->exists = true;
        if (!$permission->delete()) {
            return $this->retJson(503, '操作出错!');
        }
        $permission->saveRoles([]);
        $permission->saveMenus([]);
        return $this->retJson(200, '操作成功!');
    }

}