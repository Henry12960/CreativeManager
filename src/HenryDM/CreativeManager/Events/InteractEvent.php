<?php 

namespace HenryDM\CreativeManager\Events;

use HenryDM\CreativeManager\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\block\BlockLegacyIds;

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
        $cnperms = str_replace(["{&}", "{line}"], ["§", "\n"], $this->main->cfg->get("creative-no-perms"));
        $list = [BlockLegacyIds::CHEST, BlockLegacyIds::ENDER_CHEST, BlockLegacyIds::FURNACE, BlockLegacyIds::ANVIL, BlockLegacyIds::ITEM_FRAME_BLOCK];
# =====================================================================
        
        if($this->main->cfg->get("anti-interact") === true) {
            if($player->isCreative()) {
                if(in_array($worldName, $this->main->cfg->get("creative-moderation-worlds", []))) {
                    if(in_array($block, $list)) {
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

    public function getMain() : Main {
        return $this->main;
    }
}