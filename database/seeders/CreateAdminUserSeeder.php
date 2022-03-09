<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            
        $permissions = [
            'create-user',
         ];
    
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
        
            $user = User::create([
                'name' => 'Jalal J2HB', 
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456')
            ]);
      
            $role = Role::create(['name' => 'Super Admin','auto_ecole_id'=>1]);
            $role1 = Role::create(['name' => 'Admin','auto_ecole_id'=>1]);
       
            $permissions = Permission::pluck('id','id')->all();
      
            $role->syncPermissions($permissions);
       
            $user->assignRole([$role->id]);
        
    }
}
