<?php

namespace Zaky\Auth;

use Adldap\Adldap;
use Adldap\Models\ModelNotFoundException;
use Zaky\Contracts\Auth\Login as LoginContract;
use Zaky\Hashing\BcryptHasher;

/**
 * Class Login
 * @package Zaky\Auth
 */
class Login implements LoginContract
{
    /**
     * @var \Adldap\Connections\ProviderInterface
     */
    private $connection;
    /**
     * @var BcryptHasher
     */
    private $bcrypt;
    /**
     * @var
     */
    private $record;

    /**
     * Login constructor.
     */
    public function __construct()
    {
        $this->connection = $this->ldapProvider()->connect();
        $this->bcrypt = new BcryptHasher();
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function authenticate($username, $password)
    {
        try{
            $record = $this->connection->search()->findByOrFail('uid', $username);
        }catch (ModelNotFoundException $e){
            return false;
        }

        if ($this->bcrypt->check($password, $record->getFirstAttribute('userpassword'))){
            $this->record = $record;
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getUser()
    {
        return [
            'cn' => $this->record->getFirstAttribute('cn'),
            'gidnumber' => $this->record->getFirstAttribute('gidnumber'),
            'homedirectory' => $this->record->getFirstAttribute('homedirectory'),
            'uidnumber' => $this->record->getFirstAttribute('uidnumber'),
            'mail' => $this->record->getFirstAttribute('mail'),
            'uid' => $this->record->getFirstAttribute('uid'),
        ];
    }

    /**
     * @return $this
     */
    protected function ldapProvider()
    {
        $config = $this->config();
        return (new Adldap())->addProvider($config);
    }

    /**
     * @return array
     */
    protected function config() : array
    {
        return include (__DIR__ . '/../../config/ldap.php');
    }


}