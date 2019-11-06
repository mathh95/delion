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
	
	define('MAIL_SENDER', "sd1.emailtesthub.com");
	define('MAIL_RECEIVER', "isshak@corp.kionux.com.br");

	//keys
	define('APIKEY_GOOGLE_SERVICES', "AIzaSyAS7HedlAWWAMuzXlS8boXxNIC5RJFUH-A");
	
	define('GOOGLE_SIGNIN_CREDENTIAL', "623570251512-cprdd8eepskvicq7h7lq999e8scsd9ui");
	
	define('APIKEY_INFOBIP_SMS', "App ");//App [publickey]
?>