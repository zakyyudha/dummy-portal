<?php

namespace Zaky\Auth;

use Adldap\Adldap;
use Adldap\Auth\BindException;
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

        $dn = $record->getFirstAttribute('distinguishedname');
        $accountInfo = [
            'username' => $dn,
            'password' => $password
        ];

        try{
            $this->ldapProvider($accountInfo)->connect();
            $this->record = $record;
            return true;
        }catch (BindException $e){
            return false;
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
     * @param $config
     * @return Adldap
     */
    protected function ldapProvider($config = null)
    {
        $config = $this->config($config);
        return (new Adldap())->addProvider($config);
    }

    /**
     * @param null $accountInfo
     * @return array
     */
    protected function config($accountInfo = null) : array
    {
        $ldapConfig = include (__DIR__ . '/../../config/ldap.php');
        if(!$accountInfo){
            return $ldapConfig;
        }
        return [
            'domain_controllers' => $ldapConfig['domain_controllers'],
            'base_dn' => $ldapConfig['base_dn'],

            'admin_username' => $accountInfo['username'],
            'admin_password' => $accountInfo['password']
        ];
    }


}