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

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\utils\Config;

class EventSounds extends PluginBase{

	/** @var Config */
	public $mainconfig;

	private const CONFIG_VERSION = 2;

	private const MIN_SOUND = 0, MAX_SOUND = 29;

	/** @var int */
	public $sound = 0 , $heardby = 0;

	public function onEnable(): void{
		if($this->loadConfig()){
			$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		}
	}

	/**
	 * @return bool
	 */
	private function loadConfig(): bool{
		if(!file_exists($this->getDataFolder() . "config.yml")){
			$this->getLogger()->notice("Config.yml file was created successfully. Edit your settings there.");
		}elseif(!$this->getConfig()->exists("ConfigVersion") or $this->getConfig()->get("ConfigVersion") !== self::CONFIG_VERSION) {
			$this->getLogger()->error("Your config.yml is outdated! Please delete your current config.yml then reload or restart your server");
			$this->getServer()->getPluginManager()->disablePlugin($this);
			return false;
		}

		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->saveResource("soundsIDs.txt");
		$this->mainconfig = $this->getConfig()->getAll();

		return true;
	}

	/**
	 * Receives information from config depending on the caller and distributes the sound.
	 *
	 * @param Player $player
	 * @param string|null $event Used to search in configuration files only. Should be null if the event is external
	 * @throws
	 */
	public function Manager(Player $player, ?string $event): void{
			if($event !== null){
				$event = (new \ReflectionClass($event))->getShortName();
				$this->sound = $this->mainconfig[$event]["sound"];
				$this->heardby = $this->mainconfig[$event]["heardby"];
			}

			if($this->sound <= self::MIN_SOUND or $this->sound >= self::MAX_SOUND){
				return;
			}

			$sound = new SoundHandler($this->sound);

			new SoundPlayer($this, $sound->sound, $this->heardby, $player);
	}
}