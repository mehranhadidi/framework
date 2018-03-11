<?php

namespace App\Auth;

use App\Auth\Hashing\Hasher;
use App\Models\User;
use App\Session\SessionStore;
use Doctrine\ORM\EntityManager;

class Auth
{
    protected $db;
    protected $hasher;
    protected $session;

    public function __construct(EntityManager $db, Hasher $hasher, SessionStore $session)
    {
        $this->db = $db;
        $this->hasher = $hasher;
        $this->session = $session;
    }

    protected function getUsernameField()
    {
        return 'email';
    }

    protected function getByUsername($username)
    {
        return $this->db->getRepository(User::class)->findOneBy([
            $this->getUsernameField() => $username
        ]);
    }

    protected function hasValidCredentials($user, $password)
    {
        return $this->hasher->check($password, $user->password);
    }

    protected function setUserSession($user)
    {
        $this->session->set('id', $user->id);
    }

    public function attempt($username, $password)
    {
        $user = $this->getByUsername($username);

        if(! $user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }

        $this->setUserSession($user);

        return true;
    }
}