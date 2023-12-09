<?php

namespace Lobby\Tasks;

use Lobby\Main;
use Lobby\Utils\Utils;
use pocketmine\scheduler\AsyncTask;
use libpmquery\PMQuery;
use libpmquery\PmQueryException;
use pocketmine\utils\Config;

class UpdatePlayers extends AsyncTask
{

    public function onRun() : void{
        $res = ['count' => 0, 'maxPlayers' => 0, 'servers' => ["minestia" => 0, "arazia" => 0, "minage1" => 0, "minage2" => 0, "minage3" => 0]];
        foreach(["45.158.77.31:19133:minestia", "45.158.77.31:19134:arazia", "45.145.166.33:19138:minage1", "45.145.166.33:19130:minage2", "45.145.166.33:19139:minage3"] as $serverConfigString){
            $serverData = explode(':', $serverConfigString);
            $ip = $serverData[0];
            $port = (int) $serverData[1];

            $qData = Utils::getServer($ip, (string)$port);
            if (is_null($qData)){
                $res['count'] = -1;
                $res['maxPlayers'] += 50;
                $res['servers'][$serverData[2]] = -1;
            }else{
                if($qData->online === true){
                    $res['count'] += $qData->players->online;
                    $res['maxPlayers'] += $qData->players->max;
                    $res['servers'][$serverData[2]] += $qData->players->online;
                }
            }
        }
        $this->setResult($res);
    }

    public function onCompletion() : void{
        $res = $this->getResult();
        $cfg = new Config("/home/container/plugin_data/EndioriteLobby/cached.yml", Config::YAML);
        Main::getInstance()->players = $res['count'];
        Main::getInstance()->maxPlayers = $res['maxPlayers'];
        Main::getInstance()->servers = $res['servers'];
    }
}