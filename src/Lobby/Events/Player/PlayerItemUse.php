<?php

namespace Lobby\Events\Player;

use Lobby\Constants\WorldConstant;
use Lobby\Forms\Form\BasicForm;
use Lobby\Managers\QueueManager;
use Lobby\Utils\Utils;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\VanillaItems;
use pocketmine\item\StringToItemParser;
use pocketmine\Server;

class PlayerItemUse implements Listener {

    public function PlayerItemUseEvent(PlayerItemUseEvent $event) {

        $item = $event->getItem();
        $player = $event->getPlayer();
        $playerName = $event->getPlayer()->getName();

        if($item instanceof (VanillaBlocks::DARK_OAK_DOOR()->asItem())){
            if(QueueManager::getCurrentQueue($player) !== false){
                QueueManager::removePlayerToQueue($player, QueueManager::getCurrentQueue($player));
                $player->sendMessage("§9§lEndiorite §r§7» Vous avez bien quitté la §9file d'attente");
            }
        }

        if ($item->getTypeId() === StringToItemParser::getInstance()->parse("compass")->getTypeId()){
            BasicForm::server($player);
            return;
        }

        if ($item instanceof (VanillaItems::FEATHER())){
            $motions = clone $player->getMotion();

            $motions->x += $player->getDirectionVector()->getX() * 1.4;
            $motions->y += $player->getEyeHeight() * 0.4;
            $motions->z += $player->getDirectionVector()->getZ() * 1.4;

            $player->setMotion($motions);

        }
    }
}
