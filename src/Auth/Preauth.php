<?php

namespace Zaky\Auth;

use DartoHelm\App\Portal;
use Zaky\Contracts\Auth\Preauth as PreauthContract;

/**
 * Class Preauth
 * @package Zaky\Auth
 */
class Preauth implements PreauthContract
{
    /**
     * @param string $satelliteName
     * @return bool
     * @throws \Exception
     */
    public function preauthentication(string $satelliteName)
    {
        $satelliteList = $this->config();
        if(!array_key_exists($satelliteName, $satelliteList)){
            echo "Error 404";
            return false;
        }

        $userData = $_SESSION['USER_DETAILS'];
        $satelliteConfig = $satelliteList[$satelliteName];

        $portal = new Portal([
            'source'        => 'intranet',
            'preauthUrl'    => $satelliteConfig['preauthUrl'],
            'preauthKey'    => $satelliteConfig['preauthKey']
        ]);

        $res = $portal->sendServerPreauthRequest([
            'username' => $userData['uid'],
            'uid' => $userData['uid']
        ]);

        if(!$res){
            echo "invalid preauth response";
            return false;
        }

        if (!array_key_exists('success', $res)) {
            echo "terjadi kesalahan sistem: " . $res['error'];
            return false;
        }

        return $portal->sendTokenRedirect();

    }

    /**
     * @return array
     */
    protected function config()
    {
        return include (__DIR__ . "/../../config/preauth.php");
    }

}