<?php
/**
 * Using vanilla PHP to set the envirnoment variables.
 * Advantage of using this over the default .env: https://github.com/vlucas/phpdotenv:
 *  - Apply logic to our variables early, such as setting $baseUrl, $envirnoment, ...
 *  - Allow setting diffrent env for diffrent domains (As per Craft 2)
 *  - Allow keeping this file and overriding env variables from server config (Nginx, Apache...)
 */

$nitro = $_SERVER['SERVER_NAME'] === '_' && isset($_SERVER['SERVER_NAME']);
$protocol = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https': 'http';


if ($nitro){
    $host = $_SERVER['HTTP_HOST'];
} else {
    $host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
}

if (class_exists('Dotenv\Dotenv') && file_exists(CRAFT_BASE_PATH . '/.env')) {
    Dotenv\Dotenv::create(CRAFT_BASE_PATH)->load();
}

$baseUrl  = $protocol . '://' . $host;
$rootPath = dirname(__DIR__) . '/';


/**
 * Map a domain to an envirnoment
 * domain => env
 * @note: Matching happens from the end of the domain name as per Craft 2
 */
$environment  = 'production';
$environments = [
    '.test'           => 'dev',
    '.cloud4.tibe.no' => 'staging'
];

foreach ($environments as $domain => $env) {
    if ((strlen($baseUrl) - strlen($domain)) === strrpos($baseUrl, $domain)) {
        $environment = $env;
    }
}

/**
 * Set any envirnoment variables here.
 * These will be available across the system with getenv('VAR_NAME')
 */
$envVariables = [
    'ENVIRONMENT'     => $environment,
    'BASE_URL'        => $baseUrl,
    'SECURITY_KEY'    => '$2y$10$eXi.nmpRw7x0kQWhrM9B9upH8WROVCELHzhlhrnKA86s0h9Cfm6ye',
    'DB_DRIVER'       => 'mysql',
    'DB_SERVER'       => 'localhost',
    'DB_USER'         => '',
    'DB_PASSWORD'     => '',
    'DB_DATABASE'     => '',
    'DB_SCHEMA'       => 'public',
    'DB_TABLE_PREFIX' => '',
    'DB_PORT'         => '3306',
];

/**
 * Nitro dedicated development configuration.
 */
if ($nitro) {
    if (getenv('DB_SERVER')) {
        $envVariables['DB_SERVER']  = getenv('DB_SERVER');
    }
    if (getenv('DB_USER')) {
        $envVariables['DB_USER'] = getenv('DB_USER');
    }
    if (getenv('DB_PASSWORD')) {
        $envVariables['DB_PASSWORD'] = getenv('DB_PASSWORD');
    }
}

/**
 * Check if the env variable is already set, and if not we set it.
 */
foreach ($envVariables as $key => $value) {
    if (getenv($key) === false) {
        putenv($key . '=' . $value);
    }
}