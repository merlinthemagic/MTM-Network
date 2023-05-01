<?php
//� 2023 Martin Madsen
namespace MTM\Network\Tools\Wlan;

class MCS
{
	protected $_mcs=null;
	
	public function getByHtIndex($index, $width, $shortGuard=true)
	{
		//802.11n only as they denote the HT MCS index sequencially
		//input 23
		foreach ($this->getMcsTable() as $obj) {
			if ($obj->ht === $index && $obj->width === $width && $obj->sgi === $shortGuard) {
				return $obj;
			}
		}
		throw new \Exception("HT MCS not defined for the input");
	}
	public function getByVhtIndex($index, $ss, $width, $shortGuard=true)
	{
		//802.11n only as they denote the HT MCS index sequencially
		//input 23
		foreach ($this->getMcsTable() as $obj) {
			if ($obj->vht === $index && $obj->ss === $ss && $obj->width === $width && $obj->sgi === $shortGuard) {
				return $obj;
			}
		}
		throw new \Exception("HT MCS not defined for the input");
	}
	public function getMcsTable()
	{
		if ($this->_mcs === null) {
			
			$this->_mcs		= array();
		
			//20MHz - Long Guard interval
			
			//1 Spatial stream
			$this->_mcs[]	= (object) array("ht"=> 0, "vht" => 0, "ss" => 1, "width" => 20, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 6500000);
			$this->_mcs[]	= (object) array("ht"=> 1, "vht" => 1, "ss" => 1, "width" => 20, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 13000000);
			$this->_mcs[]	= (object) array("ht"=> 2, "vht" => 2, "ss" => 1, "width" => 20, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 19500000);
			$this->_mcs[]	= (object) array("ht"=> 3, "vht" => 3, "ss" => 1, "width" => 20, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 26000000);
			$this->_mcs[]	= (object) array("ht"=> 4, "vht" => 4, "ss" => 1, "width" => 20, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 39000000);
			$this->_mcs[]	= (object) array("ht"=> 5, "vht" => 5, "ss" => 1, "width" => 20, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => false, "rate" => 52000000);
			$this->_mcs[]	= (object) array("ht"=> 6, "vht" => 6, "ss" => 1, "width" => 20, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 58500000);
			$this->_mcs[]	= (object) array("ht"=> 7, "vht" => 7, "ss" => 1, "width" => 20, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => 65500000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 1, "width" => 20, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 78000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 1, "width" => 20, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => "n/a");
			
			//2 Spatial streams
			$this->_mcs[]	= (object) array("ht"=> 8, "vht" => 0, "ss" => 2, "width" => 20, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 13000000);
			$this->_mcs[]	= (object) array("ht"=> 9, "vht" => 1, "ss" => 2, "width" => 20, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 26000000);
			$this->_mcs[]	= (object) array("ht"=> 10, "vht" => 2, "ss" => 2, "width" => 20, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 39000000);
			$this->_mcs[]	= (object) array("ht"=> 11, "vht" => 3, "ss" => 2, "width" => 20, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 52000000);
			$this->_mcs[]	= (object) array("ht"=> 12, "vht" => 4, "ss" => 2, "width" => 20, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 78000000);
			$this->_mcs[]	= (object) array("ht"=> 13, "vht" => 5, "ss" => 2, "width" => 20, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => false, "rate" => 104000000);
			$this->_mcs[]	= (object) array("ht"=> 14, "vht" => 6, "ss" => 2, "width" => 20, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 117000000);
			$this->_mcs[]	= (object) array("ht"=> 15, "vht" => 7, "ss" => 2, "width" => 20, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => 130000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 2, "width" => 20, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 156000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 2, "width" => 20, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => "n/a");
			
			//3 Spatial streams
			$this->_mcs[]	= (object) array("ht"=> 16, "vht" => 0, "ss" => 3, "width" => 20, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 19500000);
			$this->_mcs[]	= (object) array("ht"=> 17, "vht" => 1, "ss" => 3, "width" => 20, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 39000000);
			$this->_mcs[]	= (object) array("ht"=> 18, "vht" => 2, "ss" => 3, "width" => 20, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 58500000);
			$this->_mcs[]	= (object) array("ht"=> 19, "vht" => 3, "ss" => 3, "width" => 20, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 78000000);
			$this->_mcs[]	= (object) array("ht"=> 20, "vht" => 4, "ss" => 3, "width" => 20, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 117000000);
			$this->_mcs[]	= (object) array("ht"=> 21, "vht" => 5, "ss" => 3, "width" => 20, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => false, "rate" => 156000000);
			$this->_mcs[]	= (object) array("ht"=> 22, "vht" => 6, "ss" => 3, "width" => 20, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 175500000);
			$this->_mcs[]	= (object) array("ht"=> 23, "vht" => 7, "ss" => 3, "width" => 20, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => 195000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 3, "width" => 20, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 234000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 3, "width" => 20, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => 260000000);
			
			//20MHz - Short Guard interval
			
			//1 Spatial stream
			$this->_mcs[]	= (object) array("ht"=> 0, "vht" => 0, "ss" => 1, "width" => 20, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 7200000);
			$this->_mcs[]	= (object) array("ht"=> 1, "vht" => 1, "ss" => 1, "width" => 20, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 14400000);
			$this->_mcs[]	= (object) array("ht"=> 2, "vht" => 2, "ss" => 1, "width" => 20, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 21700000);
			$this->_mcs[]	= (object) array("ht"=> 3, "vht" => 3, "ss" => 1, "width" => 20, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 28900000);
			$this->_mcs[]	= (object) array("ht"=> 4, "vht" => 4, "ss" => 1, "width" => 20, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 43300000);
			$this->_mcs[]	= (object) array("ht"=> 5, "vht" => 5, "ss" => 1, "width" => 20, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => true, "rate" => 57800000);
			$this->_mcs[]	= (object) array("ht"=> 6, "vht" => 6, "ss" => 1, "width" => 20, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 65000000);
			$this->_mcs[]	= (object) array("ht"=> 7, "vht" => 7, "ss" => 1, "width" => 20, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => 72200000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 1, "width" => 20, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 86700000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 1, "width" => 20, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => "n/a");
			
			//2 Spatial streams
			$this->_mcs[]	= (object) array("ht"=> 8, "vht" => 0, "ss" => 2, "width" => 20, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 14400000);
			$this->_mcs[]	= (object) array("ht"=> 9, "vht" => 1, "ss" => 2, "width" => 20, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 28900000);
			$this->_mcs[]	= (object) array("ht"=> 10, "vht" => 2, "ss" => 2, "width" => 20, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 43300000);
			$this->_mcs[]	= (object) array("ht"=> 11, "vht" => 3, "ss" => 2, "width" => 20, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 57800000);
			$this->_mcs[]	= (object) array("ht"=> 12, "vht" => 4, "ss" => 2, "width" => 20, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 86700000);
			$this->_mcs[]	= (object) array("ht"=> 13, "vht" => 5, "ss" => 2, "width" => 20, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => true, "rate" => 115600000);
			$this->_mcs[]	= (object) array("ht"=> 14, "vht" => 6, "ss" => 2, "width" => 20, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 130300000);
			$this->_mcs[]	= (object) array("ht"=> 15, "vht" => 7, "ss" => 2, "width" => 20, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => 144400000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 2, "width" => 20, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 173300000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 2, "width" => 20, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => "n/a");
			
			//3 Spatial streams
			$this->_mcs[]	= (object) array("ht"=> 16, "vht" => 0, "ss" => 3, "width" => 20, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 21700000);
			$this->_mcs[]	= (object) array("ht"=> 17, "vht" => 1, "ss" => 3, "width" => 20, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 43300000);
			$this->_mcs[]	= (object) array("ht"=> 18, "vht" => 2, "ss" => 3, "width" => 20, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 65000000);
			$this->_mcs[]	= (object) array("ht"=> 19, "vht" => 3, "ss" => 3, "width" => 20, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 86700000);
			$this->_mcs[]	= (object) array("ht"=> 20, "vht" => 4, "ss" => 3, "width" => 20, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 130000000);
			$this->_mcs[]	= (object) array("ht"=> 21, "vht" => 5, "ss" => 3, "width" => 20, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => true, "rate" => 173300000);
			$this->_mcs[]	= (object) array("ht"=> 22, "vht" => 6, "ss" => 3, "width" => 20, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 195000000);
			$this->_mcs[]	= (object) array("ht"=> 23, "vht" => 7, "ss" => 3, "width" => 20, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => 216700000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 3, "width" => 20, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 260000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 3, "width" => 20, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => 288900000);
			
			
			
			
			//40MHz - Long Guard interval
			
			//1 Spatial stream
			$this->_mcs[]	= (object) array("ht"=> 0, "vht" => 0, "ss" => 1, "width" => 20, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 13500000);
			$this->_mcs[]	= (object) array("ht"=> 1, "vht" => 1, "ss" => 1, "width" => 20, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 27000000);
			$this->_mcs[]	= (object) array("ht"=> 2, "vht" => 2, "ss" => 1, "width" => 20, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 40500000);
			$this->_mcs[]	= (object) array("ht"=> 3, "vht" => 3, "ss" => 1, "width" => 20, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 54000000);
			$this->_mcs[]	= (object) array("ht"=> 4, "vht" => 4, "ss" => 1, "width" => 20, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 81000000);
			$this->_mcs[]	= (object) array("ht"=> 5, "vht" => 5, "ss" => 1, "width" => 20, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => false, "rate" => 108000000);
			$this->_mcs[]	= (object) array("ht"=> 6, "vht" => 6, "ss" => 1, "width" => 20, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 121500000);
			$this->_mcs[]	= (object) array("ht"=> 7, "vht" => 7, "ss" => 1, "width" => 20, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => 135000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 1, "width" => 20, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 162000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 1, "width" => 20, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => 180000000);
			
			//2 Spatial streams
			$this->_mcs[]	= (object) array("ht"=> 8, "vht" => 0, "ss" => 2, "width" => 20, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 27000000);
			$this->_mcs[]	= (object) array("ht"=> 9, "vht" => 1, "ss" => 2, "width" => 20, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 54000000);
			$this->_mcs[]	= (object) array("ht"=> 10, "vht" => 2, "ss" => 2, "width" => 20, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 81000000);
			$this->_mcs[]	= (object) array("ht"=> 11, "vht" => 3, "ss" => 2, "width" => 20, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 108000000);
			$this->_mcs[]	= (object) array("ht"=> 12, "vht" => 4, "ss" => 2, "width" => 20, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 162000000);
			$this->_mcs[]	= (object) array("ht"=> 13, "vht" => 5, "ss" => 2, "width" => 20, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => false, "rate" => 216000000);
			$this->_mcs[]	= (object) array("ht"=> 14, "vht" => 6, "ss" => 2, "width" => 20, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 243000000);
			$this->_mcs[]	= (object) array("ht"=> 15, "vht" => 7, "ss" => 2, "width" => 20, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => 270000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 2, "width" => 20, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 324000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 2, "width" => 20, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => 360000000);
			
			//3 Spatial streams
			$this->_mcs[]	= (object) array("ht"=> 16, "vht" => 0, "ss" => 3, "width" => 20, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 40500000);
			$this->_mcs[]	= (object) array("ht"=> 17, "vht" => 1, "ss" => 3, "width" => 20, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 81000000);
			$this->_mcs[]	= (object) array("ht"=> 18, "vht" => 2, "ss" => 3, "width" => 20, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 121500000);
			$this->_mcs[]	= (object) array("ht"=> 19, "vht" => 3, "ss" => 3, "width" => 20, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => false, "rate" => 162000000);
			$this->_mcs[]	= (object) array("ht"=> 20, "vht" => 4, "ss" => 3, "width" => 20, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 243000000);
			$this->_mcs[]	= (object) array("ht"=> 21, "vht" => 5, "ss" => 3, "width" => 20, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => false, "rate" => 324000000);
			$this->_mcs[]	= (object) array("ht"=> 22, "vht" => 6, "ss" => 3, "width" => 20, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 364500000);
			$this->_mcs[]	= (object) array("ht"=> 23, "vht" => 7, "ss" => 3, "width" => 20, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => 405000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 3, "width" => 20, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => false, "rate" => 486000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 3, "width" => 20, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => false, "rate" => 540000000);
			
			//40MHz - Short Guard interval
			
			//1 Spatial stream
			$this->_mcs[]	= (object) array("ht"=> 0, "vht" => 0, "ss" => 1, "width" => 40, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 15000000);
			$this->_mcs[]	= (object) array("ht"=> 1, "vht" => 1, "ss" => 1, "width" => 40, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 30000000);
			$this->_mcs[]	= (object) array("ht"=> 2, "vht" => 2, "ss" => 1, "width" => 40, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 45000000);
			$this->_mcs[]	= (object) array("ht"=> 3, "vht" => 3, "ss" => 1, "width" => 40, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 60000000);
			$this->_mcs[]	= (object) array("ht"=> 4, "vht" => 4, "ss" => 1, "width" => 40, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 90000000);
			$this->_mcs[]	= (object) array("ht"=> 5, "vht" => 5, "ss" => 1, "width" => 40, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => true, "rate" => 120000000);
			$this->_mcs[]	= (object) array("ht"=> 6, "vht" => 6, "ss" => 1, "width" => 40, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 135000000);
			$this->_mcs[]	= (object) array("ht"=> 7, "vht" => 7, "ss" => 1, "width" => 40, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => 150000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 1, "width" => 40, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 180000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 1, "width" => 40, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => 200000000);
			
			//2 Spatial streams
			$this->_mcs[]	= (object) array("ht"=> 8, "vht" => 0, "ss" => 2, "width" => 40, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 30000000);
			$this->_mcs[]	= (object) array("ht"=> 9, "vht" => 1, "ss" => 2, "width" => 40, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 60000000);
			$this->_mcs[]	= (object) array("ht"=> 10, "vht" => 2, "ss" => 2, "width" => 40, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 90000000);
			$this->_mcs[]	= (object) array("ht"=> 11, "vht" => 3, "ss" => 2, "width" => 40, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 120000000);
			$this->_mcs[]	= (object) array("ht"=> 12, "vht" => 4, "ss" => 2, "width" => 40, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 180000000);
			$this->_mcs[]	= (object) array("ht"=> 13, "vht" => 5, "ss" => 2, "width" => 40, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => true, "rate" => 240000000);
			$this->_mcs[]	= (object) array("ht"=> 14, "vht" => 6, "ss" => 2, "width" => 40, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 270000000);
			$this->_mcs[]	= (object) array("ht"=> 15, "vht" => 7, "ss" => 2, "width" => 40, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => 300000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 2, "width" => 40, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 360000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 2, "width" => 40, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => 400000000);
			
			//3 Spatial streams
			$this->_mcs[]	= (object) array("ht"=> 16, "vht" => 0, "ss" => 3, "width" => 40, "mod" => "bpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 45000000);
			$this->_mcs[]	= (object) array("ht"=> 17, "vht" => 1, "ss" => 3, "width" => 40, "mod" => "qpsk", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 90000000);
			$this->_mcs[]	= (object) array("ht"=> 18, "vht" => 2, "ss" => 3, "width" => 40, "mod" => "qpsk", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 135000000);
			$this->_mcs[]	= (object) array("ht"=> 19, "vht" => 3, "ss" => 3, "width" => 40, "mod" => "16qam", "code" => "1/2", "symBits" => 2, "errBits" => 1, "dataBits" => 1, "sgi" => true, "rate" => 180000000);
			$this->_mcs[]	= (object) array("ht"=> 20, "vht" => 4, "ss" => 3, "width" => 40, "mod" => "16qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 270000000);
			$this->_mcs[]	= (object) array("ht"=> 21, "vht" => 5, "ss" => 3, "width" => 40, "mod" => "64qam", "code" => "2/3", "symBits" => 3, "errBits" => 1, "dataBits" => 2, "sgi" => true, "rate" => 360000000);
			$this->_mcs[]	= (object) array("ht"=> 22, "vht" => 6, "ss" => 3, "width" => 40, "mod" => "64qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 405000000);
			$this->_mcs[]	= (object) array("ht"=> 23, "vht" => 7, "ss" => 3, "width" => 40, "mod" => "64qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => 450000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 8, "ss" => 3, "width" => 40, "mod" => "254qam", "code" => "3/4", "symBits" => 4, "errBits" => 1, "dataBits" => 3, "sgi" => true, "rate" => 540000000);
			$this->_mcs[]	= (object) array("ht"=> "n/a", "vht" => 9, "ss" => 3, "width" => 40, "mod" => "254qam", "code" => "5/6", "symBits" => 6, "errBits" => 1, "dataBits" => 5, "sgi" => true, "rate" => 600000000);
		}
		return $this->_mcs;
	}
}