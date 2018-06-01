<?php

/*
 *  _______     _______ _   _ _____ ____   ___  _   _ _   _ ____  ____
 * | ____\ \   / / ____| \ | |_   _/ ___| / _ \| | | | \ | |  _ \/ ___|
 * |  _|  \ \ / /|  _| |  \| | | | \___ \| | | | | | |  \| | | | \___ \
 * | |___  \ - / | |___| |\  | | |  ___) | |_| | |_| | |\  | |_| |___) |
 * |_____|  \_/  |_____|_| \_| |_| |____/ \___/ \___/|_| \_|____/|____/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * link: https://github.com/killer549/EventSounds
*/

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
	
	public function onLogin(PlayerLoginEvent $ev){
		$this->plugin->Manager("LoginEvent", $ev->getPlayer());
	}

	public function onJoin(PlayerJoinEvent $ev){
		$this->plugin->Manager("JoinEvent", $ev->getPlayer());
	}
	
	public function onChat(PlayerChatEvent $ev){
		$this->plugin->Manager("ChatEvent", $ev->getPlayer());
	}
	
	public function onDeath(PlayerDeathEvent $ev){
		$this->plugin->Manager("DeathEvent", $ev->getPlayer());
	}
	
	public function onQuit(PlayerQuitEvent $ev){
		$this->plugin->Manager("QuitEvent", $ev->getPlayer());
	}
	
	Public function onGamemodeChange(PlayerGameModeChangeEvent $ev){
		$this->plugin->Manager("GamemodeEvent", $ev->getPlayer());
	}
	
	public function onTransfer(PlayerTransferEvent $ev){
		$this->plugin->Manager("TransferEvent", $ev->getPlayer());
	}
	
}