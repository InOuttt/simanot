<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        Role::create([
            'id' => 1,
            'type' => User::TYPE_ADMIN,
            'name' => 'Administrator',
        ]);
        Role::create([
            'id' => 2,
            'type' => User::TYPE_ADMIN,
            'name' => 'Operator',
        ]);
        Role::create([
            'id' => 3,
            'type' => User::TYPE_ADMIN,
            'name' => 'Inquiry',
        ]);
        Role::create([
            'id' => 4,
            'type' => User::TYPE_ADMIN,
            'name' => 'Supervisor',
        ]);

        // Non Grouped Permissions
        //

        // Grouped permissions
        // Users category
        $users = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user',
            'description' => 'All User Permissions',
        ]);

        $users->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.list',
                'description' => 'View Users',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.deactivate',
                'description' => 'Deactivate Users',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.reactivate',
                'description' => 'Reactivate Users',
                'sort' => 3,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.clear-session',
                'description' => 'Clear User Sessions',
                'sort' => 4,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.impersonate',
                'description' => 'Impersonate Users',
                'sort' => 5,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.change-password',
                'description' => 'Change User Passwords',
                'sort' => 6,
            ]),
        ]);

        $notaris = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.notaris',
            'description' => 'All Notaris Permissions',
        ]);
        $notaris->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.notaris.list',
                'description' => 'View Notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.notaris.create',
                'description' => 'Create Notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.notaris.update',
                'description' => 'Update Notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.notaris.delete',
                'description' => 'Delete Notaris',
            ]),
        ]);

        $akta_notaris = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.akta_notaris',
            'description' => 'All Akta Notaris Permissions',
        ]);
        $akta_notaris->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.akta_notaris.list',
                'description' => 'View Akta Notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.akta_notaris.create',
                'description' => 'Create Akta Notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.akta_notaris.update',
                'description' => 'Update Akta Notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.akta_notaris.delete',
                'description' => 'Delete Akta Notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.akta_notaris.note.list',
                'description' => 'View Akta Notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.akta_notaris.note.create',
                'description' => 'Create Akta Notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.akta_notaris.note.update',
                'description' => 'Update Akta Notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.akta_notaris.note.delete',
                'description' => 'Delete Akta Notaris',
            ]),
        ]);

        

        // Assign Permissions to other Roles
        //

        $this->enableForeignKeys();
    }
}
