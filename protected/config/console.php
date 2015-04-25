<?php
//d,slmflsmflsmlmfslfmlsmkf;klmslk;fmsfmslmfl
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.dfsbfsb
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),
    'import'=>array(
		'application.models.*',
		'application.components.*',
	),
    'aliases' => array (
        'behaviors' => realpath( __DIR__ . '/../components/behaviors/' ),
    ),

	// application components
	'components'=>array(
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=simple_app',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'zx',
			'charset' => 'utf8',
		),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);