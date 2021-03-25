<?php

namespace Vazzi\CoinsSystem;

use pocketmine\utils\Config;
use Vazzi\CoinsSystem\Main;

class CoinAPI {

    public static $cfg;

    public static function getCoinsbyPlayerName(String $playername){
        return self::$cfg->get($playername);
    }

    public static function addCoinsToPlayer(String $playername, int $coins){

        $coinsconfig = self::$cfg;

        $coinsconfig->set($playername, self::getCoinsbyPlayerName($playername)+$coins);
        $coinsconfig->save();

    }

    public static function removeCoinsFromPlayer(String $playername, int $coins){
        
        $coinsconfig = self::$cfg;

        $coinsconfig->set($playername, self::getCoinsbyPlayerName($playername)-$coins);
        $coinsconfig->save();

    }

    public static function setPlayerCoins(String $playername, int $coins){
    
        $coinsconfig = self::$cfg;

        $coinsconfig->set($playername, $coins);
        $coinsconfig->save();

    }
	
	public function getConfigString(String $context){


        return Main::$prefix . Main::getInstance()->getConfig()->get($context);

    }


}