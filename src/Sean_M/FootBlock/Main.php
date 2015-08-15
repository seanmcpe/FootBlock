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
        if($this->isPlayer($sender){
            $level->setBlock(new Vector3($floor, $block));
        }
     }

    public function onCommand(CommandSender $sender, Command $cmd, $label,array $args){
        if(strtolower($cmd->getName()) === "FootBlock"){
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
        return in_array($this->players[$player->getName());
    }

    public function removePlayer(Player $player){
        unset($this->players[$player->getName()]);
    }
}
