<?php
//© 2019 Martin Peter Madsen
namespace MTM\Network;

class Factories
{
	//USE: $aFact		= \MTM\Network\Factories::$METHOD_NAME();
	private static $_cStore=array();
	
	public static function getIp()
	{
		if (array_key_exists(__FUNCTION__, self::$_cStore) === false) {
			self::$_cStore[__FUNCTION__]	= new \MTM\Network\Factories\Ip();
		}
		return self::$_cStore[__FUNCTION__];
	}
	public static function getMac()
	{
		if (array_key_exists(__FUNCTION__, self::$_cStore) === false) {
			self::$_cStore[__FUNCTION__]	= new \MTM\Network\Factories\Mac();
		}
		return self::$_cStore[__FUNCTION__];
	}
	public static function getTools()
	{
		if (array_key_exists(__FUNCTION__, self::$_cStore) === false) {
			self::$_cStore[__FUNCTION__]	= new \MTM\Network\Factories\Tools();
		}
		return self::$_cStore[__FUNCTION__];
	}
}