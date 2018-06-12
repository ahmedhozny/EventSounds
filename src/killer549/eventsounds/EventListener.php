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

declare(strict_types = 1);

namespace killer549\eventsounds;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerTransferEvent;

class EventListener implements Listener{

	private $core;

	public function __construct(EventSounds $core){
		$this->core = $core;
	}

	public function onLogin(PlayerLoginEvent $ev){
		$this->core->Manager($ev->getPlayer(), PlayerLoginEvent::class);
	}

	public function onJoin(PlayerJoinEvent $ev){
		$this->core->Manager($ev->getPlayer(), PlayerJoinEvent::class);
	}

	public function onChat(PlayerChatEvent $ev){
		$this->core->Manager($ev->getPlayer(), PlayerChatEvent::class);
	}

	public function onDeath(PlayerDeathEvent $ev){
		$this->core->Manager($ev->getPlayer(), PlayerDeathEvent::class);
	}

	public function onQuit(PlayerQuitEvent $ev){
		$this->core->Manager($ev->getPlayer(), PlayerQuitEvent::class);
	}

	public function onGamemodeChange(PlayerGameModeChangeEvent $ev){
		$this->core->Manager($ev->getPlayer(), PlayerGameModeChangeEvent::class);
	}

	public function onTransfer(PlayerTransferEvent $ev){
		$this->core->Manager($ev->getPlayer(), PlayerTransferEvent::class);
	}
}