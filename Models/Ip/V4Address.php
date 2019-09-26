<?php
//© 2019 Martin Madsen
namespace MTM\Network\Models\Ip;

class V4Address
{
	private $_decAddr=null;
	private $_subnet=null;
	private $_ifObj=null;
	private $_toolObj=null;
	
	public function getVersion()
	{
	    return 4;
	}
	public function setFromString($str)
	{
		$ip	= preg_replace("/[^\.0-9]+/", "", $str);
		$this->set($ip);
		
		return $this;
	}
	public function set($ipStr)
	{
		if (preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $ipStr) == 1) {
			$this->_decAddr	= $ipStr;
			$this->_subnet	= null;
		} elseif (preg_match("/^([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\/([0-9]{1,2})$/", $ipStr, $raw) == 1) {
			$this->_decAddr	= $raw[1];
			$this->_subnet	= \MTM\Network\Factories::getIp()->getIPv4Subnet($raw[1], $raw[2]);
		} elseif ($ipStr === null) {
			$this->_decAddr	= null;
			$this->_subnet	= null;
		} else {
			throw new \Exception("Invalid IP");
		}
		
		return $this;
	}
	public function getDecimal()
	{
		//get as decimal notation
		if ($this->_decAddr !== null) {
			return $this->_decAddr;
		} else {
			return null;
		}
	}
	public function getInteger()
	{
	    //get as 32 bit integer
	    $ipDec     = $this->getDecimal();
	    if ($ipDec != "") {
	        return ip2long($ipDec);
	    } else {
	        return null;
	    }
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
		$this->_subnet	= $obj;
		return $this;
	}
	public function getSubnet()
	{
		return $this->_subnet;
	}
	public function setTool($obj)
	{
	    $this->_toolObj	= $obj;
	    return $this;
	}
	public function getTool()
	{
	    return $this->_toolObj;
	}
}