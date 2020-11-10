<?php


namespace linorx\JoinMessage;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class main extends PluginBase implements Listener
{
    public function onLoad()
    {
    $this->getLogger()->info(TextFormat::YELLOW."LinorxJM Plugin wird geladen");
    }
    public function onEnable()
    {
        $this->getLogger()->info(TextFormat::YELLOW."LinorxJM Plugin geladen und aktiv");
            @mkdir($this->getDataFolder());
            $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onDisable()
    {
        $this->getLogger()->warning(TextFormat::RED."LinorxJM Plugin deaktiviert");
    }
#TODO: Config hinzufügen um Nachrichten anpassen zu können(ServerName config Vorhanden!)
    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $name = $event->getPlayer()->getName();
        $servername = $this->getConfig()->get("ServerName");
        if ($player->isOp()) {
            $event->setJoinMessage(TextFormat::RED. $name .TextFormat::AQUA. " hat das Spiel betreten.");
            $player->sendMessage(TextFormat::AQUA.TextFormat::ITALIC."Wilkommen auf ".$servername." ".TextFormat::RED. $name);
        } else {
            $event->setJoinMessage(TextFormat::YELLOW. $name .TextFormat::AQUA. " hat das Spiel betreten.");
            $player->sendMessage(TextFormat::BLUE."Wilkommen auf ".$servername." ".TextFormat::RED. $name);
        }
    }
    public function onQuit(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        $name = $event->getPlayer()->getName();
        if ($player->isOp()) {
            $event->setQuitMessage(TextFormat::RED. $name .TextFormat::AQUA. " hat das Spiel verlassen");
        } else {
            $event->setQuitMessage(TextFormat::YELLOW. $name .TextFormat::AQUA. " hat das Spiel verlassen.");
        }
    }
}