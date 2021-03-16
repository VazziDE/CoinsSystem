<?php

namespace Vazzi\CoinsSystem;

use pocketMine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use Vazzi\CoinsSystem\Main;
use Vazzi\CoinsSystem\ConfigTextContainer;
use Vazzi\CoinsSystem\PluginTextContainer;


class CoinsCommand extends Command{

    public function __construct()
	{
		parent::__construct('coins');
		$this->setDescription('See how much Coins you have.');
		$this->setUsage('/coins');
	}
	
	public function getConfigString(String $context){


        return Main::$prefix . Main::getInstance()->getConfig()->get($context);

    }

	/**
	 * @param CommandSender $sender
	 * @param string $commandLabel
	 * @param string[] $args
	 * @return mixed
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
		if(!$sender instanceof Player)
		{
            return true;
        }
        if(!$sender->hasPermission(Main::getInstance()->getConfig()->get("perm"))){
            $sender->sendMessage(
                str_replace("%coins", CoinAPI::getCoinsbyPlayerName($sender->getName()), $this->getConfigString("player-coins"))
            );
            return true;
        }
        if(!isset($args[0]))
        {
            $sender->sendMessage(
                str_replace("%coins", CoinAPI::getCoinsbyPlayerName($sender->getName()), $this->getConfigString("player-coins"))
            );
            return true;
        }

        switch(strtolower($args[0])){
            case "add":
                
                if(!isset($args[1]) or !isset($args[2])){
                    $sender->sendMessage(Main::$prefix . PluginTextContainer::ADDUSAGE);
                    return true;
                }
				$target = $args[1];
                if ($sender->getServer()->getPlayer($args[1]) instanceof Player){
					$target = $sender->getServer()->getPlayer($args[1])->getName();
                }
                if(!is_numeric($args[2])){
                    $sender->sendMessage(Main::$prefix . PluginTextContainer::INTGIVEN);
                    return true;
                }
                CoinAPI::addCoinsToPlayer($target, $args[2]);
                $newstring = str_replace(["%coins", "%name"], [$args[2], $target], $this->getConfigString("add-player-coins"));
                $sender->sendMessage($newstring);

                break;

            case "remove":

				if(!isset($args[1]) or !isset($args[2])){
                    $sender->sendMessage(Main::$prefix . PluginTextContainer::REMOVEUSAGE);
                    return true;
                }
                $target = $args[1];
                if ($sender->getServer()->getPlayer($args[1]) instanceof Player){
					$target = $sender->getServer()->getPlayer($args[1])->getName();
                }
                if(!is_numeric($args[2])){
                    $sender->sendMessage(Main::$prefix . PluginTextContainer::INTGIVEN);
                    return true;
                }
                CoinAPI::removeCoinsFromPlayer($target, $args[2]);
                $newstring = str_replace(["%coins", "%name"], [$args[2], $target], $this->getConfigString("remove-player-coins"));
                $sender->sendMessage($newstring);

                break;
            case "set":

				if(!isset($args[1]) or !isset($args[2])){
                    $sender->sendMessage(Main::$prefix . PluginTextContainer::SETUSAGE);
                    return true;
                }
                $target = $args[1];
                if ($sender->getServer()->getPlayer($args[1]) instanceof Player){
					$target = $sender->getServer()->getPlayer($args[1])->getName();
                }
                if(!is_numeric($args[2])){
                    $sender->sendMessage(Main::$prefix . PluginTextContainer::INTGIVEN);
                    return true;
                }
                CoinAPI::setPlayerCoins($target, $args[2]);
                $newstring = str_replace(["%coins", "%name"], [$args[2], $target], $this->getConfigString("set-player-coins"));
                $sender->sendMessage($newstring);

                break;
            case "see":

				if(!isset($args[1])){
					$sender->sendMessage(Main::$prefix . PluginTextContainer::SEEUSAGE);
					return true;
				}
                $target = $args[1];
                if ($sender->getServer()->getPlayer($args[1]) instanceof Player){
					$target = $sender->getServer()->getPlayer($args[1])->getName();
                }
                CoinAPI::getCoinsbyPlayerName($target);
                $newstring = str_replace(["%coins", "%name"], [CoinAPI::getCoinsbyPlayerName($target), $target], $this->getConfigString("see-player-coins"));
                $sender->sendMessage($newstring);

                break;
				
            case "help":
				$sender->sendMessage(PluginTextContainer::GENUSAGE);
			break;
			
            default:
				$sender->sendMessage(PluginTextContainer::GENUSAGE);
			break;

        }

	}

}