<?php

namespace HenryDM\CreativeManager\Events;

use HenryDM\CreativeManager\Main;
use pocketmine\event\Listener;

use pocketmine\event\block\BlockPlaceEvent;

class PlaceEvent implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }
    
    public function onPlace(BlockPlaceEvent $event) { 

# =====================================================================        
        $player = $event->getPlayer();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        $mtype = $this->main->cfg->get("message-type");
        $cnperms = $this->main->cfg->get("creative-no-perms");
# =====================================================================

        if($this->main->cfg->get("anti-block-place") === true) { 
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