<?php
namespace Sean_M\FootBlock;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\math\Vector3;
use pocketmine\block\Block;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Player;

use FootBlock\Commands\Block;

class Main extends PluginBase implements Listener{

     public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getCommand("block")->setExecuter(new Commands\Block($this));
        $this->getLogger()->info(TextFormat::GREEN . "FootBlock by Sean_M enabled!");
     }

     public function onDisable(){
        $this->getLogger()->info(TextFormat::RED . "FootBlock by Sean_M disabled!");
     }
   
     public function onPlayerMove(PlayerMoveEvent $event){
        $player = $event->getPlayer();
        $level = $player->getLevel();
        $block = Block::get($player->getInventory()->getItemInHand()->getId(), 0);  
        $floor = $player->getFloorX(), $player->getFloorY() - 1, $player->getFloor();
        $level->setBlock(new Vector3($floor, $block));
     }
}
