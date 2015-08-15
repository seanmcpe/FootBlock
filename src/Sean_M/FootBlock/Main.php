<?php
namespace Sean_M\FootBlock;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\math\Vector3;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Player;

class Main extends PluginBase implements Listener{

    public $config;

     public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
          $this->saveDefaultConfig();
          $this->reloadConfig();
          $config = $this->getConfig()->getAll();
            $this->getLogger()->info(TextFormat::GREEN . "FootBlock by Sean_M enabled!");
     }
     public function onDisable(){
        $this->getLogger()->info(TextFormat::RED . "DeathDamage by Sean_M disabled!");
     }
   
     public function onPlayerMove(PlayerMoveEvent $event){
        $player = $event->getPlayer();
        $level = $player->getLevel();
        $block = $config["block"];
          $player->$level->setBlock(new Vector3($p->getFloorX(), $p->getFloorY(), $p->getFloorZ()), $block);
     }
}
