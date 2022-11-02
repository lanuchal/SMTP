<?php
	// [ton][22/04/2564][add function get format money]
	function GetMoneyFormatOne($amount,$posiion){
		// [EX] number_format($amount,2,'.',',');
		return number_format($amount,$posiion,'.',',');
	}
?>