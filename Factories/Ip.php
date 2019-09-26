<?php
//© 2019 Martin Madsen
namespace MTM\Network\Factories;

class Ip
{
	//USE: $ipObj	= \MTM\Network\Factories::getIp()->getIPv4Address("192.168.8.1", 24);
	public $_cStore=array();
	
	public function getIPv4Address($ipStr=null, $subnet=null)
	{
		$rObj	= new \MTM\Network\Models\Ip\V4Address();
		if ($ipStr !== null) {
			$rObj->setFromString($ipStr);
		}
		if ($subnet !== null) {
			if (is_object($subnet) === false) {
				$subnet	= $this->getIPv4Subnet($ipStr, $subnet);
			}
			$rObj->setSubnet($subnet);
		}
		
		$rObj->setTool($this->getIPv4Tool());
		
		return $rObj;
	}
	public function getIPv4Subnet($ipStr=null, $cidr=null)
	{
		$rObj	= new \MTM\Network\Models\Ip\V4Subnet();
		if ($ipStr !== null && $cidr !== null) {
			$rObj->setFromIpAndCidr($ipStr, $cidr);
		}
		return $rObj;
	}
	public function getIPv4Tool()
	{
		if (array_key_exists(__FUNCTION__, $this->_cStore) === false) {
			$this->_cStore[__FUNCTION__]	= new \MTM\Network\Tools\Ip\IPv4();
		}
		return $this->_cStore[__FUNCTION__];
	}
	public function getIpFromString($ipStr)
	{
		if (is_string($ipStr) === true) {
			$ipStr = trim($ipStr);
			if (preg_match("/([a-z\-])/", $ipStr) == 1) {
				//a hostname?
				$ipStr	= gethostbyname($ipStr);
			}
			if (preg_match("/^([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/", $ipStr, $raw) == 1) {
				return $this->getIPv4Address($raw[1]);
			} elseif (preg_match("/^([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\/([0-9]{1,2})$/", $ipStr, $raw) == 1) {
				
				$subnetObj  = $this->getIPv4Subnet($raw[1], $raw[2]);
				return $this->getIPv4Address($raw[1], $subnetObj);
			} else {
				throw new \Exception("Failed to get IP from string: " . $ipStr);
			}
		} else {
			throw new \Exception("Invalid Input");
		}
	}
	public function getSubnetFromString($ipStr)
	{
		$subObj = $this->getIpFromString($ipStr)->getSubnet();
		if (is_object($subObj) === true) {
			return $subObj;
		} else {
			throw new \Exception("Failed to get subnet from string: " . $ipStr);
		}
	}
}