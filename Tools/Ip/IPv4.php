<?php
//© 2019 Martin Madsen
namespace MTM\Network\Tools\Ip;

class IPv4
{
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
}