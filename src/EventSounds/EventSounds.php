<?php

namespace EventSounds;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;

use EventSounds\EventListener;
use EventSounds\Sounds;

class EventSounds extends PluginBase{
	
	public function onEnable(){
		if(!file_exists($this->getDataFolder(). "config.yml")){
			$this->getLogger()->notice("Config.yml file was created successfully.");
			$this->getLogger()->notice("Please make your own edits in config.yml");
		}
		//TODO: Check and compare between versions,because new features will be added soon.
		
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->saveResource("soundsIDs.txt");
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
	}
	
	public function Config(){
		return $this->getConfig();
	}
	
	public function getSound(){
		return new Sounds();
	}

	/*
	 * Recieves information from config depending on the caller and distributes the sound.
	 */
	public function Manager($evname, Player $player){
		$sound = $this->getSound()->soundsListener($this->Config()->get($evname));
		if($sound == 0){
			return true;
		}
		
		$level = $player->getLevel();
		foreach ($level->getPlayers() as $pos){
			$level->broadcastLevelEvent($pos, $sound);
		}
	}
}