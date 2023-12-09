<?php

namespace Lobby\Utils;

use Lobby\Main;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\effect\SaturationEffect;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\FishingRod;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\ToastRequestPacket;
use pocketmine\network\mcpe\protocol\TransferPacket;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

class Utils {

    public static function sendAchievements(Player $player, string $title = "null", string $body = "null") {
        $packet = ToastRequestPacket::create($title, $body);
        $player->getNetworkSession()->sendDataPacket($packet);
    }

    public static function checkServer($host, $port): bool
    {
        return true;
    }

    public static function transfer(Player $player, string $servername){

        if (is_null($servername) or !is_string($servername)){
            Server::getInstance()->getLogger()->alert("§4Please insert an valid Server name.");
            return;
        }

        $pk = new TransferPacket();
        $pk->address = $servername; //The server name you specified in the WaterDogPE config.
        $pk->port = 0;
        $player->getNetworkSession()->sendDataPacket($pk);
        Server::getInstance()->getLogger()->info($player->getName() . "§c a été teleporté sur le server §f{$servername}§8.");
    }


    public static function getServer($host, $port){
        $name = str_replace(" ", "", 'https://api.mcsrvstat.us/bedrock/2/' . $host . ':' . $port);
        $status = json_decode(self::file_get_contents($name));
        return $status;
    }

    public static function file_get_contents($URL){
        $c = curl_init();
        curl_setopt( $c, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $c, CURLOPT_URL, $URL );
        $contents = curl_exec( $c );
        curl_close( $c );
        if( $contents ) :
            return $contents;
        else:
            return false;
        endif;
    }

    public static function getPlayersCount(string $serverName): string|int{
        $server = Main::getInstance()->servers;
        if((int)$server[$serverName] <= -1){
            return "Error";
        }
        return (int)$serverName[$serverName];
    }

    public static function addKitLobby(Player $player){
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();

        $item = VanillaItems::COMPASS();
        $item->setCustomName("§r§aServeurs §8§l|§r §7click-droit");
        $player->getInventory()->setItem(4, $item);

    }

    public static function ffaKit(Player $player, int $type){
        $player->getArmorInventory()->clearAll();
        $player->getInventory()->clearAll();
        switch ($type) {
            case 0:
                $sword = VanillaItems::DIAMOND_SWORD();
                $sword->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 5));

                $helmet = VanillaItems::DIAMOND_HELMET();
                $helmet->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 4));
                $helmet->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 3));
                $chestplate = VanillaItems::DIAMOND_CHESTPLATE();
                $chestplate->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 4));
                $chestplate->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 3));
                $legging = VanillaItems::DIAMOND_LEGGINGS();
                $legging->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 4));
                $legging->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 3));
                $boots = VanillaItems::DIAMOND_BOOTS();
                $boots->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 4));
                $boots->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 3));

                $player->getArmorInventory()->setHelmet($helmet);
                $player->getArmorInventory()->setChestplate($chestplate);
                $player->getArmorInventory()->setLeggings($legging);
                $player->getArmorInventory()->setBoots($boots);

                $player->getInventory()->setItem(0, $sword);
                $player->getInventory()->setItem(1, VanillaItems::GOLDEN_APPLE()->setCount(10));

                $splash = VanillaItems::HEALING_SPLASH_POTION()->setCount(32);
                $player->getInventory()->addItem($splash);
                break;

            case 1:
                $sword = VanillaItems::DIAMOND_SWORD();
                $sword->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 7));

                $helmet = VanillaItems::DIAMOND_HELMET();
                $helmet->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 10));
                $helmet->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 10));
                $chestplate = VanillaItems::DIAMOND_CHESTPLATE();
                $chestplate->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 10));
                $chestplate->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 10));
                $legging = VanillaItems::DIAMOND_LEGGINGS();
                $legging->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 10));
                $legging->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 10));
                $boots = VanillaItems::DIAMOND_BOOTS();
                $boots->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 10));
                $boots->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 10));

                $player->getArmorInventory()->setHelmet($helmet);
                $player->getArmorInventory()->setChestplate($chestplate);
                $player->getArmorInventory()->setLeggings($legging);
                $player->getArmorInventory()->setBoots($boots);

                $player->getInventory()->setItem(0, $sword);
                $player->getInventory()->setItem(1, VanillaItems::ENCHANTED_GOLDEN_APPLE()->setCount(64));
            break;
        }
    }

}
