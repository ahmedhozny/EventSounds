<?php

namespace EventSounds;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerTransferEvent;

class EventListener implements Listener{
	
	private $plugin;
	
	public function __construct(EventSounds $plugin){
		$this->plugin = $plugin;
	}
	
	public function LoginEvent(PlayerLoginEvent $ev){
		$this->plugin->Manager($ev->getPlayer());
	}

	public function JoinEvent(PlayerJoinEvent $ev){
		$this->plugin->Manager($ev->getPlayer());
	}
	
	public function ChatEvent(PlayerChatEvent $ev){
		$this->plugin->Manager($ev->getPlayer());
	}
	
	public function DeathEvent(PlayerDeathEvent $ev){
		$this->plugin->Manager($ev->getPlayer());
	}
	
	public function QuitEvent(PlayerQuitEvent $ev){
		$this->plugin->Manager($ev->getPlayer());
	}
	
	Public function GamemodeEvent(PlayerGameModeChangeEvent $ev){
		$this->plugin->Manager($ev->getPlayer());
	}
	
	public function TransferEvent(PlayerTransferEvent $ev){
		$this->plugin->Manager($ev->getPlayer());
	}
	
}

