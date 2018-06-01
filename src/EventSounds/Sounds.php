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

class Sounds{

	public $sound = null;

	public function __construct(int $sound){
		$this->soundsListener($sound);
	}

	/**
	 * @param int $sound
	 * @return int
	 */
	private function soundsListener(int $sound): int{
		if($sound == "1") $sound = LevelEventPacket::EVENT_SOUND_ANVIL_BREAK;
		elseif($sound == "2") $sound = LevelEventPacket::EVENT_SOUND_ANVIL_FALL;
		elseif($sound == "3") $sound = LevelEventPacket::EVENT_SOUND_ANVIL_USE;
		elseif($sound == "4") $sound = LevelEventPacket::EVENT_SOUND_ARMOR_STAND_BREAK;
		elseif($sound == "5") $sound = LevelEventPacket::EVENT_SOUND_ARMOR_STAND_FALL;
		elseif($sound == "6") $sound = LevelEventPacket::EVENT_SOUND_ARMOR_STAND_HIT;
		elseif($sound == "7") $sound = LevelEventPacket::EVENT_SOUND_ARMOR_STAND_PLACE;
		elseif($sound == "8") $sound = LevelEventPacket::EVENT_SOUND_BLAZE_SHOOT;
		elseif($sound == "9") $sound = LevelEventPacket::EVENT_SOUND_CAMERA;
		elseif($sound == "10") $sound = LevelEventPacket::EVENT_SOUND_CLICK;
		elseif($sound == "11") $sound = LevelEventPacket::EVENT_SOUND_CLICK_FAIL;
		elseif($sound == "12") $sound = LevelEventPacket::EVENT_SOUND_DOOR;
		elseif($sound == "13") $sound = LevelEventPacket::EVENT_SOUND_DOOR_BUMP;
		elseif($sound == "14") $sound = LevelEventPacket::EVENT_SOUND_DOOR_CRASH;
		elseif($sound == "15") $sound = LevelEventPacket::EVENT_SOUND_ENDERMAN_TELEPORT;
		elseif($sound == "16") $sound = LevelEventPacket::EVENT_SOUND_FIZZ;
		elseif($sound == "17") $sound = LevelEventPacket::EVENT_SOUND_GHAST;
		elseif($sound == "18") $sound = LevelEventPacket::EVENT_SOUND_GHAST_SHOOT;
		elseif($sound == "19") $sound = LevelEventPacket::EVENT_SOUND_IGNITE;
		elseif($sound == "20") $sound = LevelEventPacket::EVENT_SOUND_ITEMFRAME_ADD_ITEM;
		elseif($sound == "21") $sound = LevelEventPacket::EVENT_SOUND_ITEMFRAME_PLACE;
		elseif($sound == "22") $sound = LevelEventPacket::EVENT_SOUND_ITEMFRAME_REMOVE;
		elseif($sound == "23") $sound = LevelEventPacket::EVENT_SOUND_ITEMFRAME_REMOVE_ITEM;
		elseif($sound == "24") $sound = LevelEventPacket::EVENT_SOUND_ITEMFRAME_ROTATE_ITEM;
		elseif($sound == "25") $sound = LevelEventPacket::EVENT_SOUND_ORB;
		elseif($sound == "26") $sound = LevelEventPacket::EVENT_SOUND_POP;
		elseif($sound == "27") $sound = LevelEventPacket::EVENT_SOUND_PORTAL;
		elseif($sound == "28") $sound = LevelEventPacket::EVENT_SOUND_SHOOT;
		elseif($sound == "29") $sound = LevelEventPacket::EVENT_SOUND_TOTEM;
		return $this->sound = $sound;
	}
} 

