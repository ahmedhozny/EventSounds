<?php

namespace EventSounds;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener{
	
	private $plugin;
	
	private $sounds;

	public function __construct(EventSounds $plugin){
		$this->plugin = $plugin;
	}
	
	public function onJoin(PlayerJoinEvent $ev){
		$p = $ev->getPlayer();
		$cfg = $this->plugin->Config()->get("JoinEvent");
		$this->plugin->Manager($this->plugin->getSound()->soundsListener($cfg), $p);
	}
	
	public function onChat(PlayerChatEvent $ev){
		$p = $ev->getPlayer();
		$cfg = $this->plugin->Config()->get("ChatEvent");
		$this->plugin->Manager($this->plugin->getSound()->soundsListener($cfg), $p);
	}
	
	public function onDeath(PlayerDeathEvent $ev){
		$p = $ev->getPlayer();
		$cfg = $this->plugin->Config()->get("DeathEvent");
		$this->plugin->Manager($this->plugin->getSound()->soundsListener($cfg), $p);
	}
	
	public function onQuit(PlayerQuitEvent $ev){
		$p = $ev->getPlayer();
		$cfg = $this->plugin->Config()->get("QuitEvent");
		$this->plugin->Manager($this->plugin->getSound()->soundsListener($cfg), $p);
	}
}

