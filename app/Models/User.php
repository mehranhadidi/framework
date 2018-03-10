<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 *
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User extends Model
{
    /**
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @name
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @ORM\Column(name="email", type="string")
     */
    protected $email;

    /**
     * @ORM\Column(name="password", type="string")
     */
    protected $password;

    /**
     * @ORM\Column(name="remember_token", type="string")
     */
    protected $remember_token;

    /**
     * @ORM\Column(name="remember_identifier", type="string")
     */
    protected $remember_identifier;
}