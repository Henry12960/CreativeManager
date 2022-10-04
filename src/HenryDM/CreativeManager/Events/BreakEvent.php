<?php

namespace HenryDM\CreativeManager\Events;

use HenryDM\CreativeManager\Main;
use pocketmine\event\Listener;

use pocketmine\event\block\BlockBreakEvent;

class BreakEvent implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }
    
    public function onBreak(BlockBreakEvent $event) { 

# =====================================================================        
        $player = $event->getPlayer();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        $mtype = $this->main->cfg->get("message-type");
        $cnperms = str_replace(["{&}", "{line}"], ["§", "\n"], $this->main->cfg->get("creative-no-perms"));
# =====================================================================

        if($this->main->cfg->get("anti-block-break") === true) { 
            if($player->isCreative()) {
                if(in_array($worldName, $this->main->cfg->get("creative-moderation-worlds", []))) {
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

    public function getMain() : Main {
        return $this->main;
    }
}