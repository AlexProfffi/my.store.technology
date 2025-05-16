<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\PermissionRegistrar;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Schema::disableForeignKeyConstraints(); // Отключаем проверку внешних ключей
        // Очищаем таблицы
        User::truncate();
        Permission::truncate();
        Role::truncate();
        Schema::enableForeignKeyConstraints(); // Включаем проверку внешних ключей


        Permission::create(['name' => 'logout']);

		$userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('logout');

		$adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('logout');


		$user = User::factory()
			->create([
				'name' => 'Alex',
				'email' => 'alex@gmail.com',
				'password' => Hash::make('11112222'),
			]);
        $user->assignRole($userRole);

		$admin = User::factory()
			->create([
				'name' => 'admin',
				'email' => 'admin@gmail.com',
				'password' => Hash::make('22221111'),
			]);
		$admin->assignRole($adminRole);

    }
}
