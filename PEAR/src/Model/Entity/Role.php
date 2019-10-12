<?php


namespace App\Model\Entity;

/**
 * Helper class. Currently this is a collection of functions which are commonly used throughout the system.
 */
class Role
{
    // Instead of using numbers such as 1, or 2 throughout our code, we give them meaningful names, and then reference
    // them like "$user->role = Role::STAFF".
    const STUDENT = 1;
    const STAFF = 2;

    public static function isStaff($roleId)
    {
        return $roleId == Role::STAFF;
    }

    public static function isStudent($roleId)
    {
        return $roleId == Role::STUDENT || Role::isStaff($roleId);
    }
}
