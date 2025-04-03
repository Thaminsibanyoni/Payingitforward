<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $subAdminRole = Role::create(['name' => 'sub-admin']);

        // Create permissions
        $manageUsers = Permission::create(['name' => 'manage-users']);
        $managePosts = Permission::create(['name' => 'manage-posts']);
        $manageStories = Permission::create(['name' => 'manage-stories']);
        $manageMessages = Permission::create(['name' => 'manage-messages']);
        $manageRewards = Permission::create(['name' => 'manage-rewards']);
        $manageDonations = Permission::create(['name' => 'manage-donations']);
        $managePayments = Permission::create(['name' => 'manage-payments']);
        $manageWithdrawals = Permission::create(['name' => 'manage-withdrawals']);
        $manageNotifications = Permission::create(['name' => 'manage-notifications']);
        $manageAnalytics = Permission::create(['name' => 'manage-analytics']);
        $manageContent = Permission::create(['name' => 'manage-content']);
        $manageSEO = Permission::create(['name' => 'manage-seo']);
        $manageSecurity = Permission::create(['name' => 'manage-security']);

        // Assign permissions to roles
        $adminRole->permissions()->attach($manageUsers->id);
        $adminRole->permissions()->attach($managePosts->id);
        $adminRole->permissions()->attach($manageStories->id);
        $adminRole->permissions()->attach($manageMessages->id);
        $adminRole->permissions()->attach($manageRewards->id);
        $adminRole->permissions()->attach($manageDonations->id);
        $adminRole->permissions()->attach($managePayments->id);
        $adminRole->permissions()->attach($manageWithdrawals->id);
        $adminRole->permissions()->attach($manageNotifications->id);
        $adminRole->permissions()->attach($manageAnalytics->id);
        $adminRole->permissions()->attach($manageContent->id);
        $adminRole->permissions()->attach($manageSEO->id);
        $adminRole->permissions()->attach($manageSecurity->id);

        $userRole->permissions()->attach($managePosts->id);
        $userRole->permissions()->attach($manageStories->id);

        $subAdminRole->permissions()->attach($manageUsers->id);
        $subAdminRole->permissions()->attach($managePosts->id);
        $subAdminRole->permissions()->attach($manageStories->id);
        $subAdminRole->permissions()->attach($manageMessages->id);
        $subAdminRole->permissions()->attach($manageDonations->id);
        $subAdminRole->permissions()->attach($managePayments->id);
        $subAdminRole->permissions()->attach($manageWithdrawals->id);
        $subAdminRole->permissions()->attach($manageNotifications->id);
        $subAdminRole->permissions()->attach($manageAnalytics->id);
        $subAdminRole->permissions()->attach($manageContent->id);
        $subAdminRole->permissions()->attach($manageSEO->id);
    }
}
