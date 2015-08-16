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
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener{

    public $players = array();

     public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TextFormat::GREEN . "FootBlock by Sean_M enabled!");
     }

     public function onDisable(){
        $this->getLogger()->info(TextFormat::RED . "FootBlock by Sean_M disabled!");
     }
   
     public function onPlayerMove(PlayerMoveEvent $event){
        $player = $event->getPlayer();
        $level = $player->getLevel();
        $block = Block::get($player->getInventory()->getItemInHand()->getId(), 0);  
        $pos = new Vector3($player->getFloorX(), $player->getFloorY() - 1, $player->getFloorZ());
        if($this->isPlayer($player)){
            $level->setBlock($pos, $block);
        }
     }

    public function onCommand(CommandSender $sender, Command $cmd, $label,array $args){
        if(strtolower($cmd->getName()) === "footblock"){
            if($sender instanceof Player){
                if($this->isPlayer($sender)){
                    $this->removePlayer($sender);
                    $sender->sendMessage(TextFormat::GOLD . "You have disabled FootBlock.");
                    return true;
                }
                else{
                    $this->addPlayer($sender);
                    $sender->sendMessage(TextFormat::GREEN . "You have enabled FootBlock.");
                    return true;
                }
            }
            else{
                $sender->sendMessage(TextFormat::RED . "Please use this command in-game.");
                return true;
            }
        }
    }

    public function addPlayer(Player $player){
        $this->players[$player->getName()] = $player->getName();
    }

    public function isPlayer(Player $player){
        return in_array($player->getName(), $this->players);
    }

    public function removePlayer(Player $player){
        unset($this->players[$player->getName()]);
    }
}
