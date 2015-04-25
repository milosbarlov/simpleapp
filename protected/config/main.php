<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Megatehna KV',
        'timeZone'=>'Europe/Belgrade',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
    'aliases' => array (
        'behaviors' => realpath( __DIR__ . '/../components/behaviors/' ),
        'ext' => realpath( __DIR__ . '/../extension/' ),
    ),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'zx',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        'xadmin'=>array(
            'class'=>'application.modules.xadmin.XadminModule',
        ),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
                'messages'=>array(

                    'class'=>'CDbMessageSource',
                     'sourceMessageTable' => 'SourceMessage',
                    'translatedMessageTable'=>'Message',
                    'cachingDuration' => 180,


                ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName' => false,     //uncomment this in case when url rewrite is implemented on server and app is in domain root.
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                'xadmin'=>'xadmin/default',
                'xadmin/<controller:\w+>/<action:\w+>/<id:\d+>'=>'xadmin/<controller>/<action>',
                'xadmin/<controller:\w+>/<action:\w+>'=>'xadmin/<controller>/<action>',
                '<seo:[a-z0-9\-_\.\/]+>'=>'site/seo',
			),
		),
		/*
		'db'=>array(
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
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);