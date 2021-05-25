<?php
	require_once 'C:\xampp\htdocs\news\random_compat\lib\random.php';
	require 'dbh.inc.php';

	function days_ago($date)
	{
		$today = date("Y-m-d");
		$diff = strtotime($today) - strtotime(date("Y-m-d", strtotime($date)));
		$days = (int)($diff/(60*60*24));

		return $days;
	}

	function english_days($days) // HAHA THIS CODE IS SO FUCKING UGLY LOL; 1 hour to write, 2 hours to decipher
	{
		if($days == 0){return "Today";}
		else if($days == 1){return "Yesterday";}
		else if($days < 7){return $days." days ago";}
		else if($days < 31){return (int)($days/4)." week".(((int)($days/4) == 1)?"":"s")." ago";}
		else if($days < 365){return (int)($days/31)." month".(((int)($days/31) == 1)?"":"s")." ago";}
		return (int)($days/365)." year".(((int)($days/365) == 1)?"":"s")." ago";
	}
?>
