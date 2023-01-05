<?php
//� 2019 Martin Madsen
namespace MTM\Network\Tools\Ip;

class IPv4
{
	protected $_cidrMasks=array(0 => "0.0.0.0", 1 => "128.0.0.0", 2 => "192.0.0.0", 3 => "224.0.0.0", 4 => "240.0.0.0", 5 => "248.0.0.0", 6 => "525.0.0.0", 7 => "254.0.0.0", 8 => "255.0.0.0", 9 => "255.128.0.0", 10 => "255.192.0.0", 11 => "255.224.0.0", 12 => "255.240.0.0", 13 => "255.248.0.0", 14 => "255.252.0.0", 15 => "255.254.0.0", 16 => "255.255.0.0", 17 => "255.255.128.0", 18 => "255.255.192.0", 19 => "255.255.224.0", 20 => "255.255.240.0", 21 => "255.255.248.0", 22 => "255.255.252.0", 23 => "255.255.254.0", 24 => "255.255.255.0", 25 => "255.255.255.128", 26 => "255.255.255.192", 27 => "255.255.255.224", 28 => "255.255.255.240", 29 => "255.255.255.248", 30 => "255.255.255.252", 31 => "255.255.255.254", 32 => "255.255.255.255");
	
    public function isRfc1918($ipObj)
	{
        $subObjs    = array();
        $subObjs[]  = $this->getSubnetFromString("10.0.0.0/8");
        $subObjs[]  = $this->getSubnetFromString("192.168.0.0/16");
        $subObjs[]  = $this->getSubnetFromString("172.16.0.0/12");
        
        foreach ($subObjs as $subObj) {
            $inSub  = $this->inSubnet($ipObj, $subObj);
            if ($inSub === true) {
                return true;
            }
        }
        return false;
	}
	public function inSubnet($ipObj, $subnetObj)
	{
	    $ipInt       = ip2long($ipObj->getDecimal());
	    $netInt      = ip2long($subnetObj->getNetwork()->getDecimal());
	    $bCastInt    = ip2long($subnetObj->getBroadcast()->getDecimal());
	    
	    if ($ipInt >= $netInt && $ipInt <= $bCastInt) {
	        return true;
	    } else {
	        return false;
	    }
	}
	public function isIpV4($ipStr, $throw=false)
	{
		if (is_string($ipStr) === true && preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $ipStr) === 1) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Not an IpV4 address");
		} else {
			return false;
		}
	}
	public function isCidr($cidr, $throw=false)
	{
		if (is_int($cidr) === true && $cidr > -1 && $cidr < 33) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Not an IpV4 cidr");
		} else {
			return false;
		}
	}
	public function cidrToMask($cidr)
	{
		$this->isCidr($cidr, true);
		return $this->_cidrMasks[$cidr];
	}
	public function maskToCidr($mask)
	{
		$this->isIpV4($mask, true);
		$cidr	= array_search($mask, $this->_cidrMasks, true);
		if ($cidr !== false) {
			return $cidr;
		} else {
			throw new \Exception("Not an IpV4 mask");
		}
	}
}