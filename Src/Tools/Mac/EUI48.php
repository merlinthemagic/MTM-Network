<?php
//© 2022 Martin Madsen
namespace MTM\Network\Tools\Mac;

class EUI48
{
	public function decToHex($input)
	{
		//input e.g: 57.75.118.8.239.253;
		if (preg_match("/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$/", $input, $raw) === 1) {
			unset($raw[0]);
			$hex	= "";
			foreach ($raw as $index => $oct) {
				$oct	= intval($oct);
				if ($oct > 256) {
					throw new \Exception("Octet: ".$index." is too large: " . $oct);
				}
				$val	= dechex($oct);
				if (strlen($val) === 1) {
					$val	= "0".$val;
				}
				$hex	.= $val;
			}
			return strtoupper($hex);
		} else {
			throw new \Exception("Input is invalid");
		}
	}
}