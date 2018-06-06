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

namespace killer549\eventsounds\externalevents;

use SimpleAuth\event\PlayerAuthenticateEvent;
use SimpleAuth\event\PlayerDeauthenticateEvent;
use SimpleAuth\event\PlayerRegisterEvent;
use SimpleAuth\event\PlayerUnregisterEvent;

class SimpleAuthPlugin extends ExternalPluginsManager{

	private const Description_Name = "SimpleAuth";

	public function EventRegistration(): void{
		$this->registerHandler(PlayerAuthenticateEvent::class, "PlayerAuthenticateEvent");
		$this->registerHandler(PlayerDeauthenticateEvent::class, "PlayerDeauthenticateEvent");
		$this->registerHandler(PlayerRegisterEvent::class, "PlayerRegisterEvent");
		$this->registerHandler(PlayerUnregisterEvent::class, "PlayerUnregisterEvent");
	}

	public function PluginName(): string{
		return self::Description_Name;
	}

	public function PlayerAuthenticateEvent(PlayerAuthenticateEvent $ev){
		$this->externalEventManager("PlayerAuthenticateEvent", $ev->getPlayer());
	}

	public function PlayerDeauthenticateEvent(PlayerDeauthenticateEvent $ev){
		$this->externalEventManager("PlayerDeauthenticateEvent", $ev->getPlayer());
	}

	public function PlayerRegisterEvent(PlayerRegisterEvent $ev){
		$this->externalEventManager("PlayerRegisterEvent", $ev->getPlayer());
	}

	public function PlayerUnregisterEvent(PlayerUnregisterEvent $ev){
		$this->externalEventManager("PlayerUnregisterEvent", $ev->getPlayer());
	}
}