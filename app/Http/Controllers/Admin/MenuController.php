<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use App\Http\Requests\Request;
use Config;
use App\Models\Admin\Role;
use App\Models\Admin\Menu;
use App\Utils\ConfigUtils;

class MenuController extends BaseController
{
    public function index()
    {
        $menus = Menu::toTree();
        $roles = Role::all();
        return view('admin.menu.list', compact('menus', 'roles'));
    }

    public function edit($id = 0)
    {
        $menu = ($id > 0) ? Menu::findByRoleId($id) : [];
        $menus = Menu::toTree();
        $roles = Role::all();
        return view('admin.menu.item', compact('menus', 'roles', 'menu'));
    }

    public function store(MenuRequest $request,Menu $menu){
        $menu->fill($request->only(['parent_id','title','icon','uri']));
        $route_key = $request->input('route_key');
        $route_value = $request->input('route_value');
        if ($route_key == 'url' && empty($route_value)) {
            $route_value = $request->input('uri');
        }
        $menu->routes = $route_key. ":" .$route_value;
        $roles = $request->input('roles');
        if (!$menu->save()) {
            return $this->retJson(503, '操作出错!');
        }
        foreach ($roles as $k => $role) {
            if (empty($role)) unset($roles[$k]);
        }
        $menu->saveRoles($roles);
        return $this->retJson(200, '操作成功!');
    }

    public function update(MenuRequest $request,Menu $menu){
        if (ConfigUtils::inConfigIds($menu->id, "admin.menu_table_cannot_manage_ids", false))
            return $this->retError(403, '该菜单禁止修改!');
        $menu->fill($request->only(['parent_id','title','icon','uri']));
        $route_key = $request->input('route_key');
        $route_value = $request->input('route_value');
        if ($route_key == 'url' && empty($route_value)) {
            $route_value = $request->input('uri');
        }
        $menu->routes = $route_key. ":" .$route_value;
        $roles = $request->input('roles');
        if (!$menu->save()) {
            return $this->retJson(503, '操作出错!');
        }
        foreach ($roles as $k => $role) {
            if (empty($role)) unset($roles[$k]);
        }
        $menu->saveRoles($roles);
        return $this->retJson(200, '操作成功!');
    }

    public function tree(Request $request)
    {
        $inputs = $request->all();
        $serialize = $inputs['tree'];
        $tree = json_decode($serialize, true);

        Menu::saveTree($tree);
        return $this->success();
    }

    public function destroy($id)
    {
        if (ConfigUtils::inConfigIds($id, "admin.menu_table_cannot_manage_ids", false))
            return $this->retError(403, '该菜单禁止删除!');
        $menu = new Menu();
        $menu->id = $id;
        $menu->exists = true;
        if (!$menu->delete()) {
            return $this->retJson(503, '操作出错!');
        }
        return $this->success();
    }
}
