<?php

namespace HenryDM\CreativeManager\Events;

use HenryDM\CreativeManager\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerGameModeChangeEvent;

class GamemodeChange implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onChange(PlayerGameModeChangeEvent $event) {

# =====================================================================        
        $player = $event->getPlayer();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        $mtype = $this->main->cfg->get("message-type");
        $cnperms = str_replace(["{&}", "{line}"], ["§", "\n"], $this->main->cfg->get("creative-no-perms"));
# ===================================================================== 

    if($this->main->cfg->("change-survival-clear") === true) {
        if(in_array($worldName, $this->main->cfg->get("creative-moderation-worlds", []))) {
            if($event->getNewGamemode() === 0) {
                $player->getInventory()->clearAll();
                $player->getArmorInventory()->clearAll();
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}