<?php

namespace Vazzi\CoinsSystem;

use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use Vazzi\CoinsSystem\Main;


class EventListener implements Listener{

    public function playerJoin(PlayerLoginEvent $event){

        $player = $event->getPlayer();
        if(!Main::$cfg->exists($player->getName())){ 
            CoinAPI::setPlayerCoins($player->getName(), Main::getInstance()->getConfig()->get("default-coins"));
        }
    }


}
