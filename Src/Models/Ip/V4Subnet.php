<?php
//© 2019 Martin Madsen
namespace MTM\Network\Models\Ip;

class V4Subnet
{
	private $_networkAddr=null;
	private $_bcastAddr=null;
	private $_cidr=null;
	
	public function setFromIpAndCidr($ipStr, $cidr)
	{
		$this->_cidr		= intval($cidr);
		
		//TODO: make fall back for ip2long func
		$intMask 			= ip2long($this->getDecimal());
		$intIp				= ip2long($ipStr);
		
		$this->_networkAddr	= \MTM\Network\Factories::getIp()->getIPv4Address(long2ip($intIp & $intMask));
		$this->_bcastAddr	= \MTM\Network\Factories::getIp()->getIPv4Address(long2ip($intIp | ~$intMask));	
	}
	public function getNetwork()
	{
		return $this->_networkAddr;
	}
	public function getBroadcast()
	{
		return $this->_bcastAddr;
	}
	public function getCidr()
	{
		return $this->_cidr;
	}
	public function getAsString($format=null)
	{
		if ($format === null || $format == "dec") {
			$format    = "std";
		}
		
		$cidr     = $this->getCidr();
		if ($cidr != "") {
			
			if ($format == "std") {
				
				$nPs 	= str_split(str_pad(str_pad("", $cidr, "1"), 32, "0"), 8);
				$rData	= "";
				foreach ($nPs as $nId => $nP) {
					if ($nId > 0) {
						$rData	.= ".";
					}
					$rData	.= bindec($nP);
				}
				
				return $rData;
				
			} else {
				throw new \Exception("Invalid Format: " . $format);
			}
		} else {
			return null;
		}
	}
}