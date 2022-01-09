<?php
//© 2022 Martin Madsen
namespace MTM\Network\Factories;

class Tools extends Base
{
	//USE: $toolObj	= \MTM\Network\Factories::getTools()->__METHOD__;

	public function getIpV4()
	{
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			$this->_s[__FUNCTION__]	= new \MTM\Network\Tools\Ip\IPv4();
		}
		return $this->_s[__FUNCTION__];
	}
	public function getMacEUI48()
	{
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			$this->_s[__FUNCTION__]	= new \MTM\Network\Tools\Mac\EUI48();
		}
		return $this->_s[__FUNCTION__];
	}
}