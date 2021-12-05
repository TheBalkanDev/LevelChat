<?php

namespace iJoshuaHD;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class LevelChat extends PluginBase implements Listener
{

    public function onLoad(): void
    {
        $this->getLogger()->info(TextFormat::WHITE . "LevelChat - activated!");
    }
    
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDisable(): void
    {
        $this->getLogger()->info("[Level Chat] Disabled!");
    }

    public function onPlayerChat(PlayerChatEvent $ev)
    {
        $p = $ev->getPlayer();
        $recipients = $ev->getRecipients();
        $array = [];
        foreach ($recipients as $m => $t) {
            if ($t instanceof Player) {
                if ($p->getWorld() !== $t->getWorld()) {
                    $array[] = $m;
                    foreach ($array as $messages) {
                        unset($recipients[$m]);
                        $ev->setRecipients(array_values($recipients));
                    }
                }
            }
        }
    }

}
