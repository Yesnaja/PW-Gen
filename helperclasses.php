<?php
	class Pw {
		public function generatePool($smallLetters, $largeLetters, $numbers, $specialLetters)
		{
			$pool = $_POST["sp_letters"];
			if($smallLetters==true)
			{
				$pool .= "qwertziuopasdfghjklyxcvbnm";
			}
			if($largeLetters==true)
			{
				$pool .= "QWERTZUIOPASDFGHJKLYXCVBNM";
			}
			if($numbers==true)
			{
				$pool .= "0123456789";
			}
			return $pool;
		}
		public function removeLetters($nl, $pool)
		{
			$result = str_split($nl);
			foreach($result AS $char)
			{
				$pool=str_replace($char,"",$pool);
			}
			return $pool;
			
		}
		public function generatePW($length, $pool)
		{
			
			$password="";
			srand ((double)microtime()*1000000);
			for($index = 0; $index < $_POST["pw_size"]; $index++)
			{
				$password .= substr($pool,(rand()%(strlen ($pool))), 1);
			}
			return $password;
		}
	}
?>