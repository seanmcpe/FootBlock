<?php
namespace Sean_M\FootBlock\Commands;

use FootBlock\Main;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\Player;

class Block implements CommandExecutor{

public function onCommand(CommandSender $sender, Command $cmd, $label,array $args){
        if(strtolower($cmd->getName()) === "command-name"){
            if($sender instanceof Player){
                if($sender->hasPermission("permission.name")){
                    $sender->sendMessage("Test command.");
                    return true;
                }
                else{
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
                    return true;
                }
            }
            else{
                $sender->sendMessage(TextFormat::RED . "Please use this command in-game.");
                return true;
            }
        }
    }
}
