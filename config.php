<?php
	// define('ADMINISTRADOR',0);
	// define('FUNCIONARIO',1);
	// define('EMPRESA', 'Delion Café');
	// define('ROOTPATH', "C:/xampp5/htdocs/web");
	// define('HOMEPATH', ROOTPATH.'/home');
	// define('ADMINPATH', ROOTPATH.'/admin');
	// define('CONTROLLERPATH', ADMINPATH . '/controler');
	// define('MODELPATH', "C:/xampp5/htdocs/web/admin/model");
	// define('VIEWPATH',  ADMINPATH .'/view');
	// define('AJAX',  ADMINPATH .'/ajax');
	// define('PICPATH',  ADMINPATH . '/fotos');
	// define('LANGPATH', VIEWPATH. '/lang');
	// define('LIBSPATH', ADMINPATH. '/lib');
?>

<?php
	define('ADMINISTRADOR',0);
	define('FUNCIONARIO',1);
	define('EMPRESA', 'Delion Café');
	define('ROOTPATH', $_SERVER['DOCUMENT_ROOT']);
	define('HOMEPATH', ROOTPATH.'/');
	define('ADMINPATH', HOMEPATH.'/admin');
	define('CONTROLLERPATH',  ADMINPATH . '/controler');
	define('MODELPATH',  ADMINPATH . '/model');
	define('VIEWPATH',  ADMINPATH .'/view');
	define('AJAX',  ADMINPATH .'/ajax');
	define('PICPATH',  ADMINPATH . '/fotos');
	define('LANGPATH', VIEWPATH. '/lang');
	define('LIBSPATH', ADMINPATH. '/lib');
	
	//keys
	define('APIKEY_GOOGLE_SERVICES', "");

	define('GOOGLE_SIGNIN_CREDENTIAL', "");

	define('APIKEY_INFOBIP_SMS', "App ");//App [publickey]
?>