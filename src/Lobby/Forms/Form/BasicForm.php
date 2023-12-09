<?php

namespace Lobby\Forms\Form;

use Lobby\Constants\PrefixConstant;
use Lobby\Forms\FormAPI\SimpleForm;
use Lobby\Main;
use Lobby\Utils\Utils;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\SingletonTrait;
use Endiorite\Constants\CustomUserInterface;

class BasicForm{
    
    public static function server(Player $player){
        $form = self::createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }
            
            switch($result){
                case 0:
                    $player->transfer("45.158.77.31", 19137);
                    break;
               	case 1:
                    $player->transfer("arazia");
                    break;
              	case 2:
                    $player->transfer("minestia");
                    break;
                case 4:
                case 3:
                    $minages = [
                        "minage1" => 19138,
                        "minage2" => 19130,
                        "minage3" => 19139
                    ];
                    $minage = array_rand($minages);
                    while(count($minages) > 0){
                        if(Utils::getPlayersCount($minage) >= 20){
                            unset($minages[$minage]);
                            if(empty($minages))
                            {
                                break;
                            }else{
                            	$minage = array_rand($minages);
                            }
                            continue;
                        }
                    
                        break;
                    }
                
                    if(count($minages) > 0){
                        $player->transfer($minage);
                    }else{
                        $player->sendMessage(PrefixConstant::error_prefix . "§cLes minages sont pleins ! revenez plus tard...");
                    }
                    break;
            }


            return true;

        });
        $form->setTitle(self::getDeviceOS($player));
        $form->addButton("farmland");
        $form->addButton("imbali");
        $form->addButton("manashino");
        $form->addButton("minage");
        $form->addButton("untaa");
        $player->sendForm($form);
    }
    
    public static function getDeviceOS($player){
        $device = $player->getPlayerInfo()->getExtraData()["DeviceOS"];
        $title = "fr.endiorite.server";
        if($device == 11){
            $title = "Serveur"; 
        }
        if($device == 12){
            $title = "Serveur"; 
        }
        if($device == 13){
            $title = "Serveur";
        }
        return $title;
    }

    public static function test(Player $player){
        $form = self::createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }

            var_dump($result);


            return true;

        });
        $form->setTitle("test");
        $form->setContent("test");
        $form->addButton("estsetststst", 0,"textures/customui/jobs/buttons/Mineur");
        $form->addButton("estsetststst", 0,"textures/customui/jobs/buttons/Farmeur");
        $form->addButton("estsetststst", 0,"textures/customui/jobs/buttons/Hunter");
        $form->addButton("estsetststst", 0,"textures/customui/jobs/buttons/Alchimiste");
        $player->sendForm($form);
        //$player->sendForm(FormBuilder::newSimple("Player: {$target->getName()}", $target->getUniqueId()->toString())->withButton("Send message", fn() => ...)->build());
    }

    public static function createSimpleForm(callable $function = null) : SimpleForm {
        return new SimpleForm($function);
    }

}
