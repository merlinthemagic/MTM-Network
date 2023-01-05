<?php
//� 2019 Martin Madsen
namespace MTM\Network\Models\Ip;

class V4Address
{
	protected $_ip=null;
	protected $_subObj=null;

	public function getVersion()
	{
	    return 4;
	}
	public function setFromString($str)
	{
		if (is_string($str) === false) {
			throw new \Exception("Invalid Input");
		}
		$ipStr	= preg_replace("/[^\.0-9\/]+/", "", $str);
		
		if (preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $ipStr) === 1) {
			$this->_ip		= $ipStr;
			$this->_subObj	= null;
		} elseif (preg_match("/^([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\/([0-9]{1,2})$/", $ipStr, $raw) == 1) {
			$this->_ip		= $raw[1];
			$this->_subObj	= \MTM\Network\Factories::getIp()->getIPv4Subnet($raw[1], $raw[2]);
		} else {
			throw new \Exception("Invalid Input");
		}

		return $this;
	}
	public function getDecimal()
	{
		return $this->_ip;
	}
	public function getInteger()
	{
		return ip2long($this->getDecimal());
	}
	public function getAsString($format=null, $inclSubnet=null)
	{
		if ($format === null || $format == "dec") {
	        $format    = "std";
	    }
	    if ($inclSubnet === null) {
	        $inclSubnet    = true;
	    }
	    $ipDec     = $this->getDecimal();
	    if ($ipDec != "") {
	        
	        $subObj    = $this->getSubnet();
	        if ($format == "std") {
	        	
	            $rData     = $ipDec;
	            if ($inclSubnet === true && is_object($subObj) === true) {
	                $rData .= "/" . $subObj->getCidr();
	            }
	            return $rData;
	            
	        } elseif ($format == "hex") {
	        	
	        	$ipPs      = explode(".", $ipDec);
	        	$rData     = "";
	        	foreach ($ipPs as $pId => $part) {
	        		if ($pId > 0) {
	        			$rData     .= ":";
	        		}
	        		$hexPart   = strtoupper(dechex($part));
	        		$pLen      = strlen($hexPart);
	        		$rData     .= str_repeat("0", (2-$pLen)) . $hexPart;
	        	}
	        	if ($inclSubnet === true && is_object($subObj) === true) {
	        		$rData .= "/" . $subObj->getCidr();
	        	}
	        	return $rData;
	        	
	        } else {
	            throw new \Exception("Invalid Format: " . $format);
	        }
	        
	    } else {
	    	return null;
	    }
	}
	public function setSubnet($obj)
	{
		$this->_subObj	= $obj;
		return $this;
	}
	public function getSubnet()
	{
		return $this->_subObj;
	}
	public function getTool()
	{
		return \MTM\Network\Factories::getTools()->getIPv4();
	}
}