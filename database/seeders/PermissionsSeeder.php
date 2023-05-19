<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'about',
            'slider',
            'categories',
            'languages',
            'settings',
            'seo-tags',
            'users',
            'permissions',
            'report',
            'dodenv',
            'UseFulLink',
            'news',
            'content',
            'gallery',
            'writer',
        ];
        foreach ($permissions as $permission) {
            add_permission($permission);
        }
        $singlePermissions = [
            'contact index',
            'contact delete',
            'newsletter index',
            'newsletter create',
            'newsletter delete',
        ];
        foreach ($singlePermissions as $single) {
            $permission = new \Spatie\Permission\Models\Permission();
            $permission->name = $single;
            $permission->guard_name = 'admin';
            $permission->save();
        }
    }
}
