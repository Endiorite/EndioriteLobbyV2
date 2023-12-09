<?php

namespace Lobby\Commands\joueur;

use Lobby\Constants\PrefixConstant;
use Lobby\Constants\WorldConstant;
use Lobby\Forms\Form\BasicForm;
use Lobby\Managers\AntiMultiManager;
use Lobby\Utils\Utils;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissionNames;
use pocketmine\player\Player;
use pocketmine\Server;

class LobbyCommand extends Command
{

    public function __construct() {
        parent::__construct("lobby", "", "/lobby", ["lobby", "spawn", "hub"]);
        $this->setPermission(DefaultPermissionNames::COMMAND_TELL);
    }

    public function execute(CommandSender|Player $sender, string $commandLabel, array $args): void{
        if (!$sender instanceof Player) return;
    }
}