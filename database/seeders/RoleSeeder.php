<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'Admin']);
        $role2 = Role::create(['name'=>'Blogger']);

        permission::create(['name' => 'cursos.index'])->syncRoles([$role1, $role2]);
        permission::create(['name' => 'cursos.create'])->syncRoles([$role1, $role2]);
        permission::create(['name' => 'cursos.edit'])->syncRoles([$role1, $role2]);
        permission::create(['name' => 'cursos.destroy'])->syncRoles([$role1, $role2]);


    }
}
