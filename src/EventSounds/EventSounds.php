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
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->saveResource("soundsIDs.txt");
		$this->Config()->save();
		
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
	}

	public function Config(){
		return $this->getConfig();
	}
	
	public function getSound(){
		return new Sounds();
	}
	
	public function Manager($sound, Player $player){
		if($sound == "0"){
			return true;
		}
		
		$level = $player->getLevel();
		foreach ($player->getLevel()->getPlayers() as $pos){
			$level->broadcastLevelEvent($pos, $sound);
		}
	}

}
