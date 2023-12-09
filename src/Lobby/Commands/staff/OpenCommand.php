<?php

/**
 *  ______           _ _            _ _
 * |  ____|         | (_)          (_) |
 * | |__   _ __   __| |_  ___  _ __ _| |_ ___
 * |  __| | '_ \ / _` | |/ _ \| '__| | __/ _ \
 * | |____| | | | (_| | | (_) | |  | | ||  __/
 * |______|_| |_|\__,_|_|\___/|_|  |_|\__\___|
 *This program is source code on minecraft endiorite server,
 * you may not modify it or use it for personal use
 *
 * @author Endiorite Team
 * @link http://www.endiorite.fr/
 */

namespace Lobby\Commands\staff;

use Lobby\Constants\MessageConstant;
use Lobby\Constants\PrefixConstant;
use Lobby\Entities\NPCEntity;
use Lobby\Entities\TitleEntity;
use Lobby\Main;
use pocketmine\command\CommandSender;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\player\Player;

class OpenCommand extends \pocketmine\command\Command
{

    public function __construct() {
        parent::__construct("openserv", "", "", []);
        $this->setPermission("npc.use");
    }

    public function execute(CommandSender|Player $sender, string $commandLabel, array $args): void{
        if(!$sender->hasPermission("npc.use")) {
            $sender->sendMessage(MessageConstant::no_permission);
            return;
        }

        if (!isset($args[0])) return;

        if ($args[0] === "all"){
            Main::$OPEN["minestia"] = true;
            Main::$OPEN["arazia"] = true;
            Main::$OPEN["minage"] = true;
        }

        if ($args[0] === "close"){
            Main::$OPEN["minestia"] = false;
            Main::$OPEN["arazia"] = false;
            Main::$OPEN["minage"] = false;
        }

        if (!isset(Main::$OPEN[$args[0]]) || !Main::$OPEN[$args[0]]){
            Main::$OPEN[$args[0]] = true;
            $sender->sendMessage("Les servers sont open");
            return;
        }

        Main::$OPEN[$args[0]] = false;
        $sender->sendMessage("Les servers sont fermer");
    }
}