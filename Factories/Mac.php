<?php
//© 2019 Martin Madsen
namespace MTM\Network\Factories;

class Mac extends Base
{
	//USE: $macObj	= \MTM\Network\Factories::getMac()->getEui48("AABBCCDDEEFF");

	public function getEui48($macStr=null)
	{
		$rObj	= new \MTM\Network\Models\Mac\EUI48();
		if ($macStr !== null) {
			$rObj->setFromString($macStr);
		}
		return $rObj;
	}
}