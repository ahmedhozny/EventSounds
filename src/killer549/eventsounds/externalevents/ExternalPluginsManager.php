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

use killer549\eventsounds\EventSounds;

use pocketmine\event\EventPriority;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\MethodEventExecutor;

abstract class ExternalPluginsManager implements Listener{

	/** @var EventSounds */
	private $core;

    public function __construct(EventSounds $core){
    	$this->core = $core;
    	if($this->checkPlugin($this->PluginName())){
    		$this->eventRegistration();
		}
    }

	private function checkPlugin(string $pluginName): bool{
    	if($this->getCore()->mainconfig["ExternalPlugins"][$pluginName] === true){
			$plugin = $this->getCore()->getServer()->getPluginManager()->getPlugin($pluginName);
    		if($plugin !== null and $this->getCore()->getServer()->getPluginManager()->isPluginEnabled($plugin)){
				$this->getCore()->saveResource($this->getCore()::ExternalDIR . $pluginName . ".yml");
				return true;
			}

			$this->getCore()->getLogger()->notice("Plugin " . $pluginName . " is disabled or does not exist.");
		}
		return false;
	}

	/**
	 * @param string $event
	 * @param string $method
	 * @param bool $ignoreCancelled
	 */
	public function registerHandler(string $event, string $method, bool $ignoreCancelled = false ): void{
    	$this->getCore()->getServer()->getPluginManager()->registerEvent($event, $this,EventPriority::MONITOR,
			new MethodEventExecutor($method), $this->getCore(), $ignoreCancelled);
	}
	
	/**
	 * @param string $event
	 * @param string|Player $player
	 */
	public function externalEventManager(string $event, $player){
		if(!$player instanceof Player){
			$player = $this->getCore()->getServer()->getPlayer($player);
		}
		
		$this->getCore()->Manager($event, $player, $this->PluginName());
	}

	/**
	 * @return EventSounds
	 */
	public function getCore(): EventSounds{
    	return $this->core;
	}

	abstract public function eventRegistration(): void;

    abstract public function PluginName(): string;
}