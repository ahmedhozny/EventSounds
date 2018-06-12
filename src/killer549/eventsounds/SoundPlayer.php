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

declare(strict_types=1);

namespace killer549\eventsounds;

use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\Player;

class SoundPlayer{

	public function __construct(EventSounds $core, int $sound, $heardby,Player $player){
			$pk = new LevelEventPacket();
			$pk->evid = $sound;
			$pk->data = 0;
			$players = $core->getServer()->getOnlinePlayers();
			switch($heardby ?? 3){
				case 1:
					$pk->position = $player->asVector3();
					$player->batchDataPacket($pk);
					break;

				case 2:
					unset($players[array_search($player, $players)]);
					foreach($players as $pos){
						$pk->position = $pos->asVector3();
						$pos->batchDataPacket($pk);
					}
					break;

				case 3:
				default:
					foreach($players as $pos) {
						$pk->position = $pos->asVector3();
						$pos->batchDataPacket($pk);
			}
		}
	}
}