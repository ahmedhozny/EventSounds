<?php


/*
 *  _______     _______ _   _ _____ ____   ___  _   _ _   _ ____  ____  
 * | ____\ \   / / ____| \ | |_   _/ ___| / _ \| | | | \ | |  _ \/ ___| 
 * |  _|  \ \ / /|  _| |  \| | | | \___ \| | | | | | |  \| | | | \___ \ 
 * | |___  \ V / | |___| |\  | | |  ___) | |_| | |_| | |\  | |_| |___) |
 * |_____|  \_/  |_____|_| \_| |_| |____/ \___/ \___/|_| \_|____/|____/ 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * link: https://github.com/killer549/EventSounds
*/

declare(strict_types=1);

namespace killer549\eventsounds\externalevents;

use onebone\economyapi\event\money\AddMoneyEvent;
use onebone\economyapi\event\money\MoneyChangedEvent;
use onebone\economyapi\event\money\PayMoneyEvent;
use onebone\economyapi\event\money\ReduceMoneyEvent;
use onebone\economyapi\event\money\SetMoneyEvent;

class EconomyAPIPlugin extends ExternalPluginsManager{

	private const Description_Name = "EconomyAPI";

	public function eventRegistration(): void{
		$this->registerHandler(AddMoneyEvent::class, "AddMoneyEvent");
		$this->registerHandler(MoneyChangedEvent::class, "MoneyChangedEvent");
		$this->registerHandler(PayMoneyEvent::class, "PayMoneyEvent");
		$this->registerHandler(ReduceMoneyEvent::class, "ReduceMoneyEvent");
		$this->registerHandler(SetMoneyEvent::class, "SetMoneyEvent");
	}

	public function PluginName(): string{
		return self::Description_Name;
	}

	public function AddMoneyEvent(AddMoneyEvent $ev){
		$this->externalEventManager("AddMoneyEvent", $ev->getUsername());
	}

	public function MoneyChangedEvent(MoneyChangedEvent $ev){
		$this->externalEventManager("MoneyChangedEvent", $ev->getUsername());
	}
	
	public function PayMoneyEvent(PayMoneyEvent $ev){
		$this->externalEventManager("PayMoneyEvent", $ev->getTarget());
	}

	public function ReduceMoneyEvent(ReduceMoneyEvent $ev){
		$this->externalEventManager("ReduceMoneyEvent", $ev->getUsername());
	}

	public function SetMoneyEvent(SetMoneyEvent $ev){
		$this->externalEventManager("SetMoneyEvent", $ev->getUsername());
	}
}