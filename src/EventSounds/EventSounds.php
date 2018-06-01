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

use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;

class EventSounds extends PluginBase{

	private $config;

	protected const CONFIG_VERSION = 2;

	private const MIN_SOUND = 0, MAX_SOUND = 29;

	public function onEnable(): void{
		if($this->loadConfig()){
			$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		}
	}
	
	/**
	 * @return bool
	 */
	public function loadConfig(): bool{
		if(!file_exists($this->getDataFolder() . "config.yml")){
			$this->getLogger()->notice("Config.yml file was created successfully.");
			$this->getLogger()->notice("Please make your own edits in config.yml");
		}elseif(!$this->getConfig()->exists("configVersion") or $this->getConfig()->get("configVersion") < self::CONFIG_VERSION) {
			$this->getLogger()->error("Your config.yml needs to be updated. Please delete or move and copy later the file.");
			$this->getServer()->getPluginManager()->disablePlugin($this);
			return false;
		}

		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->saveResource("externalevents.yml");
		$this->saveResource("soundsIDs.txt");

		if($this->getConfig()->get("enableExternalEvents") === true){
			// TODO : Some code here to enable External Events
		}

		$this->config = $this->getConfig()->getAll();

		return true;
	}

	/**
	 * Receives information from config depending on the caller and distributes the sound.
	 *
	 * @param $event
	 * @param Player $player
	 */
	public function Manager($event, Player $player): void{
		$soundID = $this->config[$event]["sound"];
		if($soundID <= self::MIN_SOUND or $soundID >= self::MAX_SOUND){
			return;
		}

		$sound = new Sounds($soundID);

		$this->soundPlayer($sound->sound, $this->config[$event]["hearby"], $player);
	}

	private function soundPlayer(int $sound, int $hearby, Player $player): void{
		$pk = new LevelEventPacket();
		$pk->evid = $sound;
		$pk->data = 0;
		$players = $this->getServer()->getOnlinePlayers();
		switch($hearby){
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