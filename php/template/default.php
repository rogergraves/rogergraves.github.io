<? 
	ob_start();
?>
--PHP-alt-<?php echo $random_hash; ?> 
Content-Type: text/html; charset="utf8" 
Content-Transfer-Encoding: 7bit

Name: <? echo $name; ?>
Message: <? echo $message; ?>




--PHP-alt-<?php echo $random_hash; ?>--
<?
	$contents=ob_get_contents();
   ob_end_clean();
   return($contents);
?>


	