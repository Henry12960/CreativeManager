<?php

namespace HenryDM\CreativeManager\Events;

use HenryDM\CreativeManager\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;

class PvpEvent implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) {

# ===================================================================== 
        $entity = $event->getEntity();      
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        $mtype = $this->main->cfg->get("message-type");
        $cnperms = str_replace(["{&}", "{line}"], ["§", "\n"], $this->main->cfg->get("creative-no-perms"));
# ===================================================================== 

        if($this->main->cfg->get("anti-pvp") === true) {
            if($event instanceof EntityDamageByEntityEvent) {
                $damager = $event->getDamager();
                if(!$damager instanceof Player) return;
                if(in_array($worldName, $this->main->cfg->get("creative-moderation-worlds", []))) {
                    if($damager->isCreative()) {
                        $event->cancel();
                    }
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}