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
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $mtype = $this->main->cfg->get("message-type");
        $cnperms = str_replace(["{&}", "{line}"], ["§", "\n"], $this->main->cfg->get("creative-no-perms"));
        $gm = $event->getNewGamemode();
        $ngm = 0;
# ===================================================================== 

        if($this->main->cfg->get("change-survival-clear") === true) {
            if(in_array($worldName, $this->main->cfg->get("creative-moderation-worlds", []))) {
                if($gm === $ngm) {
                    $player->getInventory()->clearAll();
                    $player->getArmorInventory()->clearAll();
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}