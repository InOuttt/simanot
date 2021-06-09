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
        $roleOperator = Role::create([
            'id' => 2,
            'type' => User::TYPE_ADMIN,
            'name' => 'Operator',
        ]);
        $roleInquiry = Role::create([
            'id' => 3,
            'type' => User::TYPE_ADMIN,
            'name' => 'Inquiry',
        ]);
        // Role::create([
        //     'id' => 4,
        //     'type' => User::TYPE_ADMIN,
        //     'name' => 'Supervisor',
        // ]);

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

        $permissionNotaris = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.notaris',
            'description' => 'All Notaris Permissions',
        ]);
        $permissionNotaris->children()->saveMany([
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

        $permissionCluster = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.cluster',
            'description' => 'All Cluster Permissions',
        ]);
        $permissionCluster->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.cluster.list',
                'description' => 'View Cluster',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.cluster.create',
                'description' => 'Create Cluster',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.cluster.update',
                'description' => 'Update Cluster',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.cluster.delete',
                'description' => 'Delete Cluster',
            ]),
        ]);

        $covernote = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.covernote',
            'description' => 'All Covernote Permissions',
        ]);
        $covernote->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.covernote.list',
                'description' => 'View Covernote',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.covernote.create',
                'description' => 'Create Covernote',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.covernote.update',
                'description' => 'Update Covernote',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.covernote.delete',
                'description' => 'Delete Covernote',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.covernote_document.list',
                'description' => 'View Dokumen Covernote',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.covernote_document.create',
                'description' => 'Create Dokumen Covernote',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.covernote_document.update',
                'description' => 'Update Dokumen Covernote',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.covernote_document.delete',
                'description' => 'Delete Dokumen Covernote',
            ]),
        ]);

        $inquiry = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.inquiry',
            'description' => 'All Covernote Permissions',
        ]);
        $inquiry->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.inquiry.status_akta',
                'description' => 'View Inquiry status dokumen',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.inquiry.index_notaris',
                'description' => 'View Inquiry index notaris',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.inquiry.surat_tagihan',
                'description' => 'View Inquiry surat tagihan',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.inquiry.grup_hukum',
                'description' => 'View Inquiry grup hukum',
            ]),
        ]);

        

        // Assign Permissions to other Roles
        //
        $roleOperator->givePermissionTo($covernote);
        $roleOperator->givePermissionTo($permissionNotaris);
        $roleOperator->givePermissionTo($permissionCluster);
        $roleOperator->givePermissionTo($inquiry);
        $roleInquiry->givePermissionTo($inquiry);
        // $akta_notaris->syncRoles($roles);

        $this->enableForeignKeys();
    }
}
