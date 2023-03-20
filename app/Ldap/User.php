<?php

namespace App\Ldap;

use LdapRecord\Models\Model;

class User extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'test1simple1';
}
