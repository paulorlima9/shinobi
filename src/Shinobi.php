<?php

namespace Shinobi;

use Shinobi\Tactics\AssignRoleTo;
use Shinobi\Tactics\GivePermissionTo;
use Shinobi\Tactics\RevokePermissionFrom;

class Shinobi
{
    /**
     * Fetch an instance of the Role model.
     *
     * @return Role
     */
    public function role()
    {
        return app()->make(config('shinobi.models.role'));
    }

    /**
     * Fetch an instance of the Permission model.
     *
     * @return Permission
     */
    public function permission()
    {
        return app()->make(config('shinobi.models.permission'));
    }

    /**
     * Assign roles to a user.
     *
     * @param  string|array  $roles
     * @return \Shinobi\Tactic\AssignRoleTo
     */
    public function assign($roles): AssignRoleTo
    {
        return new AssignRoleTo($roles);
    }

    /**
     * Give permissions to a user or role
     *
     * @param  string|array  $permissions
     * @return \Shinobi\Tactic\GivePermissionTo
     */
    public function give($permissions): GivePermissionTo
    {
        return new GivePermissionTo($permissions);
    }

    /**
     * Revoke permissions from a user or role
     *
     * @param  string|array  $permissions
     * @return \Shinobi\Tactic\RevokePermissionFrom
     */
    public function revoke($permissions): RevokePermissionFrom
    {
        return new RevokePermissionFrom($permissions);
    }
}
