<?php

namespace HenryDM\CreativeManager;

# =======================
#    Pocketmine Class
# =======================

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

# =======================
#      Plugin Class
# =======================

use HenryDM\CreativeManager\Events\BreakEvent;
use HenryDM\CreativeManager\Events\GamemodeChange;
use HenryDM\CreativeManager\Events\InteractEvent;
use HenryDM\CreativeManager\Events\PlaceEvent;
use HenryDM\CreativeManager\Events\ProjectileEvent;
use HenryDM\CreativeManager\Events\PvpEvent;

class Main extends PluginBase implements Listener {  
    
    /*** @var Main|null */
    private static Main|null $instance;

    /*** @var Config */
    public Config $cfg;    

    public function onEnable() : void {
        $this->saveResource("config.yml");
        $this->cfg = $this->getConfig();

        $events = [
            BreakEvent::class,
            GamemodeChange::class,
            InteractEvent::class,
            PlaceEvent::class,
            ProjectileEvent::class,
            PvpEvent::class
        ];
        foreach($events as $ev) {
            $this->getServer()->getPluginManager()->registerEvents(new $ev($this), $this);
        }
    }

    public function onLoad() : void {
        self::$instance = $this;
    }

    public function getInstance() : Main {
        return self::$instance;
    }

    public function getMainConfig() : Config {
        return $this->cfg;
    }