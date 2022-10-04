<?php

namespace HenryDM\CreativeManager\Events;

use HenryDM\CreativeManager\Main;
use pocketmine\event\Listener;

use pocketmine\entity\projectile\Arrow;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\player\Player;

class ProjectileEvent implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }
    
    public function onLaunch(ProjectileLaunchEvent $event) {

# =====================================================================  
        $player = $event->getPlayer();
        $entity = $event->getEntity();      
        $oentity = $entity->getOwningEntity();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $mtype = $this->main->cfg->get("message-type");
        $cnperms = str_replace(["{&}", "{line}"], ["§", "\n"], $this->main->cfg->get("creative-no-perms"));
# =====================================================================

        if($this->main->cfg->get("anti-bow") === true) { 
            if($player->isCreative()) {
                if(in_array($worldName, $this->main->cfg->get("creative-moderation-worlds", []))) {
                    if($entity instanceof Arrow) {
                        if($oentity instanceof Player) {
                            $event->cancel();
                            if($mtype === "message") {
                                $player->sendMessage($cnperms);
                            }
                    
                            if($mtype === "popup") {
                                $player->sendPopup($cnperms);
                            }
                        }
                    }
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}