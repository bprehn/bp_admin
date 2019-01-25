<?php
	$siteName 		= "Mount Kato";
	$key 			= 'Uk23Isag8f31nn0n47R222wAOp0ZQMT4'; // key for password salt
	$slugFind 		= array(' - ',' ','`','~','!','@','#','$','%','^','&','*','(',')','_','=','+','{','[',']','}','\\','|',';',':','"','\'','<','\,','>','.','/','?',' at ',' the ',' for ',' in ',' a ',' to ');
	$slugReplace 	= array('-','-','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','', '','','','','','');
	$numFind 		= array('1','2','3');
	$numReplace 	= array('One', 'Two', 'Three');
	$find 			= array('src="../uploadIMG', 'src="../img', '<ul>', '<li>', 'stage/', 'http:');
	$replace 		= array('src="uploadIMG', 'src="img', '<ul class="fa-ul">', '<li><i class="fa-li fa fa-chevron-right"></i>', '', 'https:');
	$banners		= '2'; // 1 for use just 1 height for interior extior  and 2 for 1 for home and inteior
	$bannerWidth 	= '1200';
	$bannerHeight 	= '540';
	$bannerIntWidth 	= '1200';
	$bannerIntHeight 	= '540';
	$calloutImgWidth	 = '410';
	$calloutImghHeight 	= '666';
	$defaultEmail 	= '';
	$analytics 		= ''; //uses google analytics
	$analyticsUrl 	= '';
	$maxCol 		= 2;
	define('BASE_URL', 'https://www.mountkato.com/');
?>
