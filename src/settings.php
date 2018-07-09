<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],
		'jwt' => [
			'secret' => getenv('JWT_SECRET'),
			'expires' => getenv('JWT_TTL')
		],
		'db' => [
			'driver' => getenv('DB_DRIVER'),
			'host' => getenv('DB_HOST'),
			'port' => getenv('DB_PORT'),
			'name' => getenv('DB_NAME'),
			'user' =>  getenv('DB_USER'),
			'password' => getenv('DB_PASS')
//			'driver' => 'pgsql',
//			'host' => 'localhost',
//			'port' => 5432,
//			'name' => 'slim',
//			'user' =>  'root',
//			'password' => '1234'
		],
		'facebook' => [
			'config' => [
				'app_id' => getenv('FACEBOOK_APP_ID'),
				'app_secret' => getenv('FACEBOOK_APP_SECRET'),
				'default_graph_version' => getenv('FACEBOOK_DEFAULT_GRAPH_VERSION'),
			],
			'redirect_uri' => getenv('REDIRECT_URI')
		]
    ],
];
