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

class SoundHandler{

	/** @var int */
	public $sound;

	public function __construct(int $sound){
		$this->soundHandler($sound);
	}

	/**
	 * @param int $sound
	 * @return int
	 */
	private function soundHandler(int $sound): int{
		switch($sound) {
	    	    case 1:
			$sound = LevelEventPacket::EVENT_SOUND_ANVIL_BREAK;
		    break;
		    case 2:
			$sound = LevelEventPacket::EVENT_SOUND_ANVIL_FALL;
		    break;
		    case 3:
			$sound = LevelEventPacket::EVENT_SOUND_ANVIL_USE;
		    break;
		    case 4:
			$sound = LevelEventPacket::EVENT_SOUND_ARMOR_STAND_BREAK;
		    break;
		    case 5:
			$sound = LevelEventPacket::EVENT_SOUND_ARMOR_STAND_FALL;
		    break;
		    case 6:
			$sound = LevelEventPacket::EVENT_SOUND_ARMOR_STAND_HIT;
		    break;
		    case 7:
			$sound = LevelEventPacket::EVENT_SOUND_ARMOR_STAND_PLACE;
		    break;
		    case 8:
			$sound = LevelEventPacket::EVENT_SOUND_BLAZE_SHOOT;
		    break;
		    case 9:
			$sound = LevelEventPacket::EVENT_SOUND_CAMERA;
		    break;
		    case 10:
			$sound = LevelEventPacket::EVENT_SOUND_CLICK;
		    break;
		    case 11:
			$sound = LevelEventPacket::EVENT_SOUND_CLICK_FAIL;
		    break;
		    case 12:
			$sound = LevelEventPacket::EVENT_SOUND_DOOR;
		    break;
		    case 13:
			$sound = LevelEventPacket::EVENT_SOUND_DOOR_BUMP;
		    break;
		    case 14:
			$sound = LevelEventPacket::EVENT_SOUND_DOOR_CRASH;
		    break;
		    case 15:
			$sound = LevelEventPacket::EVENT_SOUND_ENDERMAN_TELEPORT;
		    break;
		    case 16:
			$sound = LevelEventPacket::EVENT_SOUND_FIZZ;
		    break;
		    case 17:
			$sound = LevelEventPacket::EVENT_SOUND_GHAST;
		    break;
		    case 18:
			$sound = LevelEventPacket::EVENT_SOUND_GHAST_SHOOT;
		    break;
		    case 19:
			$sound = LevelEventPacket::EVENT_SOUND_IGNITE;
		    break;
		    case 20:
			$sound = LevelEventPacket::EVENT_SOUND_ITEMFRAME_ADD_ITEM;
		    break;
		    case 21:
			$sound = LevelEventPacket::EVENT_SOUND_ITEMFRAME_PLACE;
		    break;
		    case 22:
			$sound = LevelEventPacket::EVENT_SOUND_ITEMFRAME_REMOVE;
		    break;
		    case 23:
			$sound = LevelEventPacket::EVENT_SOUND_ITEMFRAME_REMOVE_ITEM;
		    break;
		    case 24:
			$sound = LevelEventPacket::EVENT_SOUND_ITEMFRAME_ROTATE_ITEM;
		    break;
		    case 25:
			$sound = LevelEventPacket::EVENT_SOUND_ORB;
		    break;
		    case 26:
			$sound = LevelEventPacket::EVENT_SOUND_POP;
		    break;
		    case 27:
			$sound = LevelEventPacket::EVENT_SOUND_PORTAL;
		    break;
		    case 28:
			$sound = LevelEventPacket::EVENT_SOUND_SHOOT;
		    break;
		    case 29:
			$sound = LevelEventPacket::EVENT_SOUND_TOTEM;
		    break;
		    default:
			$sound = LevelEventPacket::EVENT_SOUND_ANVIL_BREAK;
		    break;
		}
		return $this->sound = $sound;
	}
} 

