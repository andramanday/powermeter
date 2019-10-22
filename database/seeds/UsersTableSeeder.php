<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Company;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'com_name' => 'PT. Graha Mitra Teguh',
            'com_location' => 'Jakarta Selatan',
            'com_address' => 'Jakarta Selatan',
            'com_status' => '1'
        ]);

        
        $SuperadminRole = Role::create(['name' => 'Super-Admin']);
        $SuperadminPermissions = ['manage-users', 'view-users', 'create-users', 'edit-users', 'delete-users','manage-companies', 'view-companies', 'create-companies', 'edit-companies', 'delete-companies',];
        foreach($SuperadminPermissions as $ap)
        {
            $permission = Permission::create(['name' => $ap]);
            $SuperadminRole->givePermissionTo($permission);
        }
        $SuperadminUser = User::create([
            'name' => 'Andra',
            'email' => 'andra.manday@gmail.com',
            'password' => Hash::make('12345'),
            'cid' => '1'
        ]);
        $SuperadminUser->assignRole($SuperadminRole);

        $adminRole = Role::create(['name' => 'Admin']);
        $adminPermissions = ['manage-users', 'view-users', 'create-users', 'edit-users', 'delete-users'];
        foreach($adminPermissions as $ap)
        {
            $permission = Permission::firstOrCreate(['name' => $ap]);
            $adminRole->givePermissionTo($permission);
        }
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234'),
            'cid' => '1'
        ]);
        $adminUser->assignRole($adminRole);

        $editorRole = Role::create(['name' => 'Editor']);
        $editorPermissions = ['manage-users', 'view-users'];

        foreach($editorPermissions as $ep)
        {
            $permission = Permission::firstOrCreate(['name' => $ep]);
            $editorRole->givePermissionTo($permission);
        }
        $editorUser = User::create([
            'name' => 'Editor',
            'email' => 'editor@example.com',
            'password' => Hash::make('1234'),
            'cid' => '1'
        ]);
        $editorUser->assignRole($editorRole);

        $userRole = Role::create(['name' => 'User']);
        $generalUser = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('1234'),
            'cid' => '1'
        ]);
        $generalUser->assignRole($userRole);
    }
}
