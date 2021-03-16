# CoinsSystem
CoinsSystem Plugin for PocketMine-MP Server Software.
This CoinsSystem allows your player to have coins, as a server admin you can add, remove, set, see and get the Coins Amount of a Player.

![icon](https://user-images.githubusercontent.com/45903049/111331522-44e1b080-8671-11eb-8d46-5f0bd18eb0c1.png)

**HOW TO USE IT?**

Players can see their Coins with the command /coins and server admins can change the coins from players with the following commands.

*/coins add playername 5000* - to add coins to a player.
*/coins remove playername 5000* - to remove coins from a player.
*/coins set playername 5000* - to set the Coins Amount of a player.
*/coins see playername* - to see how much coins a player have.

**How to get the plugin?**

1. Download the plugin from here.
2. Drag the plugin into your plugin order on the server.
3. Start the Server.
4. Modify the config, which you find in the plugin_data\CoinsSystem order.
5. Have fun with plugin.


**SIMPLY API FOR YOUR PLUGIN**

*If you want to get the Coins from a Player by a Plugin use this code:*

```
$playercoins = $this->getServer()->getPluginManager()->getPlugin("CoinsSystem")->getCoins($player->getName());
$player->sendMessage($player->getName() . $coins);
```

*If you want to add Coins to a Player by a Plugin use this code:*

```
$this->getServer()->getPluginManager()->getPlugin("CoinsSystem")->addCoins($player->getName(), 1000);
```

*If you want to remove Coins from a Player by a Plugin use this code:*

```
$this->getServer()->getPluginManager()->getPlugin("CoinsSystem")->removeCoins($player->getName(), 1000);
```

*If you want to set Coins Amount from a Player by a Plugin use this code:*

```
$this->getServer()->getPluginManager()->getPlugin("CoinsSystem")->setCoins($player->getName(), 1000);
```




