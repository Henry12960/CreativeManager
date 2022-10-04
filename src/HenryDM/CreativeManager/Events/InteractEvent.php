<?php 

namespace HenryDM\CreativeManager\Events;

use HenryDM\CreativeManager\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerInteractEvent;

class InteractEvent implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onInteract(PlayerInteractEvent $event) {

# =====================================================================        
        $player = $event->getPlayer();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        $mtype = $this->main->cfg->get("message-type");
        $cnperms = $this->main->cfg->get("creative-no-perms");
# =====================================================================
        
        if($this->main->cfg->get("anti-chest-open") === true) {
            if($player->isCreative()) {
                if(in_array($worldName, $this->main->cfg->get("creative-moderation-worlds", []))) {
            }
        } 
    }
}