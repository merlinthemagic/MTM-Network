<?php
//© 2019 Martin Madsen
namespace MTM\Network\Models\Mac;

class EUI48
{
	private $_hexAddr=null;
	
	public function setFromString($str)
	{
	    $str       = trim($str);
	    $seps	   = trim(preg_replace("/[a-fA-F0-9]+/", "", $str));
	    $sepLen    = strlen($seps);
	    if ($sepLen == 5) {
	        //many application outputs truncate leading 0's in mac addresses parts
	        $mPs   = explode($seps[0], $str);
	        $str   = "";
	        foreach ($mPs as $mp) {
	            $mpLen = strlen(trim($mp));
	            if ($mpLen == 1) {
	                $str   .= "0" . $mp;
	            } elseif ($mpLen == 0) {
	                $str   .= "00";
	            } else {
	                $str   .= $mp;
	            }
	        }
	    }

		$mac			= preg_replace("/[^a-fA-F0-9]+/", "", $str);
		if (strlen($mac) == 12) {
			$this->_hexAddr		= strtoupper($mac);
			return $this;
		} else {
			throw new \Exception("Not Handled");
		}
	}
	public function setFromDecimal($int)
	{
		$this->setFromString(dechex($int));
	}
	public function getAsString($format=null)
	{
		if ($format == "std" || $format === null) {
			return implode(":", str_split($this->_hexAddr, 2));
		} elseif ($format == "hex") {
			return $this->_hexAddr;
		} elseif ($format == "dec") {
			return hexdec($this->_hexAddr);
		} else {
			throw new \Exception("Not Handled");
		}
	}
}