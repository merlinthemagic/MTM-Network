<?php
//� 2019 Martin Madsen
namespace MTM\Network\Factories;

class Ip extends Base
{
	//USE: $ipObj	= \MTM\Network\Factories::getIp()->getIPv4Address("192.168.8.1", 24);
	
	public function getIPv4Address($ipStr=null, $subnet=null)
	{
		$rObj	= new \MTM\Network\Models\Ip\V4Address();
		if ($ipStr !== null) {
			$rObj->setFromString($ipStr);
		}
		if ($subnet !== null) {
			if ($subnet instanceof \MTM\Network\Models\Ip\V4Subnet === false) {
				$subnet		= $this->getIPv4Subnet($ipStr, $subnet);
			}
			$rObj->setSubnet($subnet);
		}
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