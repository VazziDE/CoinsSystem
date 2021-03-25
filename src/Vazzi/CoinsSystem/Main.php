<?php

declare(strict_types=1);

namespace Vazzi\CoinsSystem;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\command\Command;
use Vazzi\CoinsSystem\CoinAPI;

class Main extends PluginBase {

    public static $cfg;
    public static $prefix;

    public static $instance;

    public static function getInstance() {
        return self::$instance;
    }

    public function onload(){
        self::$instance = $this;
    }

    public function onEnable(){
		
        $this->saveResource("config.yml");
		$this->init();

    }
	
	public function init(){
		self::$cfg = new Config($this->getDataFolder() . "PlayerCoins.yml", 2);
        CoinAPI::$cfg = new Config($this->getDataFolder() . "PlayerCoins.yml", 2);
		$this->saveResource($this->getDataFolder() . "PlayerCoins.yml");
        self::$prefix = self::$cfg->get("prefix");
		$this->registerCommand();
        $this->registerEvent();
	}

    public function registerCommand(){
        $this->getServer()->getCommandMap()->register('CoinsSystem', new CoinsCommand());
    }

    public function registerEvent(){
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }
	
    public function getCoins(String $playername){return self::$cfg->get($playername);}
    public function addCoins(String $playername, int $coins){CoinAPI::addCoinsToPlayer($playername, $coins);}
    public function removeCoins(String $playername, int $coins){CoinAPI::removeCoinsFromPlayer($playername, $coins);}
    public function setCoins(String $playername, int $coins){CoinAPI::setPlayerCoins($playername, $coins);}

}
