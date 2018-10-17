<?php

use Illuminate\Database\Seeder;

class AdminMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_menus')->delete();
        \DB::table('admin_menus')->insert(array (
            0 => 
                array (
                    'id'            => 1,
                    'parent_id'     => 0,
                    'order'         => 4,
                    'title'         => '权限管理',
                    'icon'          => 'fa-users',
                    'uri'           => '',
                    'routes'        => 'url:/admin',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            1 =>
                array (
                    'id'            => 2,
                    'parent_id'     => 1,
                    'order'         => 5,
                    'title'         => '管理员管理',
                    'icon'          => 'fa-user',
                    'uri'           => '/admin/admin_user',
                    'routes'        => 'url:/admin/admin_user',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            2 =>
                array (
                    'id'            => 3,
                    'parent_id'     => 1,
                    'order'         => 6,
                    'title'         => '角色管理',
                    'icon'          => 'fa-user-md',
                    'uri'           => '/admin/role',
                    'routes'        => 'url:/admin/role',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            3 =>
                array (
                    'id'            => 4,
                    'parent_id'     => 1,
                    'order'         => 7,
                    'title'         => '权限管理',
                    'icon'          => 'fa-pause',
                    'uri'           => '/admin/permission',
                    'routes'        => 'url:/admin/permission',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            4 =>
                array (
                    'id'            => 5,
                    'parent_id'     => 1,
                    'order'         => 8,
                    'title'         => '菜单管理',
                    'icon'          => 'fa-calendar',
                    'uri'           => '/admin/menu',
                    'routes'        => 'url:/admin/menu',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                )
            )
        );
    }
}