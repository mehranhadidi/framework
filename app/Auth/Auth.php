<?php

namespace App\Auth;

use App\Auth\Hashing\Hasher;
use App\Models\User;
use App\Session\SessionStore;
use Doctrine\ORM\EntityManager;
use Exception;

class Auth
{
    protected $db;
    protected $hasher;
    protected $session;
    protected $user;

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

    protected function getById($id)
    {
        return $this->db->getRepository(User::class)->find($id);
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

    public function attempt($username, $password)
    {
        $user = $this->getByUsername($username);

        if(! $user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }

        if($this->needsRehash($user)) {
            $this->rehash($user, $password);
        }

        $this->setUserSession($user);

        return true;
    }

    public function needsRehash($user)
    {
        return $this->hasher->needsRehash($user->password);
    }

    public function rehash($user, $password)
    {
        $this->db->getRepository(User::class)->find($user->id)->update([
            'password' => $this->hasher->create($password),
        ]);

        $this->db->flush();
    }

    protected function setUserSession($user)
    {
        $this->session->set('id', $user->id);
    }

    public function check()
    {
        return $this->hasUserInSession();
    }

    public function hasUserInSession()
    {
        return $this->session->exists(
            $this->key()
        );
    }

    public function key()
    {
        return 'id';
    }

    public function setUserFromSession()
    {
        $user = $this->getById(
            $this->session->get(
               $this->key()
            )
        );

        if(! $user) {
            throw new Exception('Unauthorized');
        }

        $this->user = $user;
    }

    public function logout()
    {

    }

    public function user()
    {
        return $this->user;
    }
}