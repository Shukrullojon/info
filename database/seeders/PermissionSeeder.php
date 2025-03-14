<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionList = [
            // home page
            [
                'name' => "home-show",
                'info' => "Главная страница",
            ],
            [
                'name' => 'home-index',
                'info' => "Главная страница",
            ],
            [
                'name' => 'home-profile',
                'info' => "Профиль",
            ],
            // permission page
            [
                'name' => 'permission-show',
                'info' => "Разрешение (показать)",
            ],
            [
                'name' => 'permission-index',
                'info' => "Разрешение (лист)",
            ],
            [
                'name' => 'permission-create',
                'info' => "Разрешение (создать)",
            ],
            [
                'name' => 'permission-store',
                'info' => "Разрешение (сохранить)",
            ],
            [
                'name' => 'permission-edit',
                'info' => "Разрешение (редоктировать)",
            ],
            [
                'name' => 'permission-update',
                'info' => "Разрешение (редоктировать 2)",
            ],
            [
                'name' => 'permission-destroy',
                'info' => "Разрешение (удалит)",
            ],
            // role page
            [
                'name' => 'role-index',
                'info' => "Роли (лист)",
            ],
            [
                'name' => 'role-filter',
                'info' => "Роли (фильтр)",
            ],
            [
                'name' => 'role-show',
                'info' => "Роли (показать)",
            ],
            [
                'name' => 'role-create',
                'info' => "Роли (создать)",
            ],
            [
                'name' => 'role-store',
                'info' => "Роли (сохранит)",
            ],
            [
                'name' => 'role-edit',
                'info' => "Роли (редоктировать)",
            ],
            [
                'name' => 'role-update',
                'info' => "Роли (редоктировать 2)",
            ],
            [
                'name' => 'role-destroy',
                'info' => "Роли (удалит)",
            ],
            // user page
            [
                'name' => 'user-index',
                'info' => "Пользователи (лист)",
            ],
            [
                'name' => 'user-filter',
                'info' => "Пользователи (фильтр)",
            ],
            [
                'name' => 'user-create',
                'info' => "Пользователи (создать)",
            ],
            [
                'name' => 'user-store',
                'info' => "Пользователи (сохранит)",
            ],
            [
                'name' => 'user-show',
                'info' => "Пользователи (показать)",
            ],
            [
                'name' => 'user-edit',
                'info' => "Пользователи (редоктировать)",
            ],
            [
                'name' => 'user-update',
                'info' => "Пользователи (редоктировать 2)",
            ],
            [
                'name' => 'user-destroy',
                'info' => "Пользователи (удалить)",
            ],
        ];
        foreach ($permissionList as $item => $value){
            Permission::updateOrCreate([
                'name' => $value['name'],
            ], [
                'info' => $value['info']
            ]);
        }
    }
}
