<?php
//� 2019 Martin Madsen
namespace MTM\Network\Models\Ip;

class V4Subnet
{
	private $_network=null;
	private $_cidr=null;
	
	public function setFromIpAndCidr($ipStr, $cidr)
	{
		$this->getTool()->isIpV4($ipStr, true);
		$this->getTool()->isCidr($cidr, true);
		$this->_network		= long2ip(ip2long($ipStr) & ip2long($this->getTool()->cidrToMask($cidr)));
		$this->_cidr		= $cidr;
	}
	public function getNetwork()
	{
		return $this->_network;
	}
	public function getCidr()
	{
		return $this->_cidr;
	}
	public function getBroadcast()
	{
		return long2ip(ip2long($this->_network) | ip2long(long2ip(~ip2long($this->getTool()->cidrToMask($this->_cidr)))));
	}
	public function inSubnet($ipStr, $throw=false)
	{
		$this->getTool()->isIpV4($ipStr, true);
		$netInt		= ip2long($this->getNetwork());
		$ipInt		= ip2long($ipStr);
		$bcastInt	= ip2long($this->getBroadcast());
		
		if ($netInt <= $ipInt && $ipInt <= $bcastInt) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("IP is not in subnet");
		} else {
			return false;
		}
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
	public function getTool()
	{
		return \MTM\Network\Factories::getTools()->getIPv4();
	}
}