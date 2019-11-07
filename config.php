<?php

	//sys paths
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
	
	//db
	define('DB_HOST', "localhost");
	define('DB_NAME', "delioncafe");
	define('DB_USER', "root");
	define('DB_PASS', "");

	//Mail
	define('MAIL_SENDER', "teste@teste.com");
	define('MAIL_RECEIVER', "isshak@corp.kionux.com.br");
	
	/*apikeys*/
	//google
	define('APIKEY_GOOGLE_SERVICES', "AIzaSyAS7HedlAWWAMuzXlS8boXxNIC5RJFUH-A");
	define('GOOGLE_SIGNIN_CREDENTIAL', "623570251512-cprdd8eepskvicq7h7lq999e8scsd9ui");
	define('GOOGLE_reCAPTCHA', "6LcSi8EUAAAAAE4di6kXe7QJVJ_ksbBx076pnnOv");
	define('GOOGLE_reCAPTCHA_SECRET', "6LcSi8EUAAAAANWwu_J4OGCEAP0Kj8d2RFXGMcPG");
	
	//facebook
	define('FACEBOOK_APP_ID', "487115355479930");
	
	//infobip
	define('BASE_URL_INFOBIP', "https://5v8vmz.api.infobip.com");
	define('APIKEY_INFOBIP_SMS', "App f39320ed23950c8cb78e188ec43063e8-d7ade8a2-6026-4674-9588-d738df82822b");//App [publickey]
?>