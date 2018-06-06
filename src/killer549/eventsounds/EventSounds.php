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

use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\utils\Config;

class EventSounds extends PluginBase{

	/** @var Config */
	public $mainconfig;

	protected const CONFIG_VERSION = 2;
	
	public const ExternalDIR = "externalplugins/";

	private const MIN_SOUND = 0, MAX_SOUND = 29;

	public function onEnable(): void{
		if($this->loadConfig()){
			$this->getServer()->getPluginManager()->registerEvents(new InternalEventListener($this), $this);
		}
	}

	/**
	 * @return bool
	 */
	private function loadConfig(): bool{
		if(!file_exists($this->getDataFolder() . "config.yml")){
			$this->getLogger()->notice("Config.yml file was created successfully."." edit your settings there.");
			$this->getLogger()->notice("Please visit https://github.com/killer549/EventSounds/wiki for information about this plugin");
		}elseif(!$this->getConfig()->exists("configVersion") or $this->getConfig()->get("configVersion") !== self::CONFIG_VERSION) {
			$this->getLogger()->error("Your config.yml is outdated! Please delete your current config.yml then reload or restart your server");
			$this->getServer()->getPluginManager()->disablePlugin($this);
			return false;
		}

		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->saveResource("soundsIDs.txt");
		$this->mainconfig = $this->getConfig()->getAll();
		new RegisterExternalPlugins($this);

		return true;
	}

	/**
	 * Receives information from config depending on the caller and distributes the sound.
	 *
	 * @param string $event Used to search in configuration files only.
	 * @param Player $player
	 * @param string $plugin if null, the method should be called by core (Pocketmine) event.
	 */
	public function Manager(string $event, Player $player, string $plugin = null): void{
		if($plugin !== null){
			$extcfg = (new Config($this->getDataFolder(). self::ExternalDIR. $plugin. ".yml", Config::YAML))->getAll();
			$soundID = $extcfg[$event]["sound"];
			$heardby = $extcfg[$event]["heardby"];
		}else{
			$soundID = $this->mainconfig[$event]["sound"];
			$heardby = $this->mainconfig[$event]["heardby"];
		}

		if($soundID <= self::MIN_SOUND or $soundID >= self::MAX_SOUND){
			return;
		}

		$sound = new Sounds($soundID);

		$this->soundPlayer($sound->sound, $heardby, $player);
	}

	private function soundPlayer(int $sound, $heardby, Player $player): void{
		$pk = new LevelEventPacket();
		$pk->evid = $sound;
		$pk->data = 0;
		$players = $this->getServer()->getOnlinePlayers();
		switch($heardby ?? 3){
			case 1:
				$pk->position = $player->asVector3();
				$player->batchDataPacket($pk);
				break;

			case 2:
				unset($players[array_search($player, $players)]);
				foreach($players as $pos){
					$pk->position = $pos->asVector3();
					$this->getServer()->batchPackets([$pos], [$pk]);
				}
				break;

			case 3:
			default:
				foreach($players as $pos) {
					$pk->position = $pos->asVector3();
					$this->getServer()->batchPackets([$pos], [$pk]);
				}
		}
	}
}