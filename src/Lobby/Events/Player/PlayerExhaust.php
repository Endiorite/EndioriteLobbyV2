<?php

namespace Lobby\Events\Player;

use Lobby\Constants\MessageConstant;
use Lobby\Constants\PrefixConstant;
use Lobby\Managers\QueueManager;
use Lobby\Utils\Utils;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\world\Position;
use Lobby\Main;

class PlayerExhaust implements Listener{

    public function PlayerExhaust(PlayerExhaustEvent $event){
        $event->cancel();
    }
}
