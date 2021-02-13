<?php

//DO NOT MODIFY ANY CODE OR USE IT BEFORE ASKING ME

namespace AutoGG;

use pocketmine\plugin\PluginBase;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\{PlayerJoinEvent, PlayerDeathEvent};
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info("AutoGG By Blaze7105 is enabled!");
    }

    public function onJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $this->count[$player->getName()] = 0;
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
    if (isset($args[0])) {
        switch ($args[0]) {
            case "enable":
                $sender->sendMessage("AutoGG is now Enabled!");
                $this->count[$sender->getName()] = 1;
                return true;
                break;
            case "disable":
                $this->count[$sender->getName()] = 0;
                $sender->sendMessage("AutoGG is now Disabled!");
                return true;
                break;
        }
    }
    return false;
    }
    public function onDeath(PlayerDeathEvent $event){
        $server = $this->getServer();
        $p = $event->getPlayer();
        if($p->getLastDamageCause() instanceof EntityDamageByEntityEvent){
            $killer = $p->getLastDamageCause()->getDamager();
            if($killer instanceof Player){
                if($this->count[$killer->getName()] === 1) {
                    $killer->chat("gg");
                }
            }
        }
    }
}