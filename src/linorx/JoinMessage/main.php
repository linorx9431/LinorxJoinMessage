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
        $join = $this->getConfig()->get("MessageOnJoin");
        $joinOP = $this->getConfig()->get("MessageOnJoinOP");
        $messageOP = $this->getConfig()->get("JoinMessageOP");
        $message = $this->getConfig()->get("JoinMessage");
        if ($player->isOp()) {
            $event->setJoinMessage(TextFormat::RED. $name .TextFormat::AQUA.$joinOP);
            $player->sendMessage(TextFormat::AQUA.TextFormat::ITALIC.$messageOP.TextFormat::GOLD.$name);
        } else {
            $event->setJoinMessage(TextFormat::YELLOW. $name .TextFormat::AQUA.$join);
            $player->sendMessage(TextFormat::BLUE.$message.TextFormat::YELLOW.$name);
        }
    }
    public function onQuit(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        $name = $event->getPlayer()->getName();
        $quit = $this->getConfig()->get("MessageOnQuit");
        $quitOP = $this->getConfig()->get("MessageOnQuitOP");
        if ($player->isOp()) {
            $event->setQuitMessage(TextFormat::RED. $name .TextFormat::AQUA.$quitOP);
        } else {
            $event->setQuitMessage(TextFormat::YELLOW. $name .TextFormat::AQUA.$quit);
        }
    }
}