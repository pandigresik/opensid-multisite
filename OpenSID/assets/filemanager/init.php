<?php
define('ENVIRONMENT', 'production');

$ds = DIRECTORY_SEPARATOR;
define('BASEPATH', dirname(dirname(dirname(__FILE__))));
define('FCPATH', BASEPATH . $ds);
define('DESAPATH', dirname(BASEPATH) . $ds . 'sites-desa' . $ds);
define('APPPATH', BASEPATH . $ds . 'donjo-app' . $ds);
define('LIBPATH', BASEPATH . "{$ds}system{$ds}libraries{$ds}Session{$ds}");
define('APP_URL', ($_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http') . "://{$_SERVER['HTTP_HOST']}".str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']));

require_once LIBPATH . 'Session_driver.php';
require_once LIBPATH . "drivers{$ds}Session_files_driver.php";
require_once BASEPATH . "{$ds}system{$ds}core{$ds}Common.php";
$root_folder = $_SERVER['DOCUMENT_ROOT'];
$config_desa_path = $root_folder.$ds.'desa'.$ds.'config/config.php';
require_once $config_desa_path;

$session_name_desa = $config['sess_cookie_name'];

$config = get_config();

if (empty($config['sess_save_path'])) {
    $config['sess_save_path'] = rtrim(ini_get('session.save_path'), '/\\');
}

$config = array(
    'cookie_lifetime'   => $config['sess_expiration'],
    // 'cookie_name'       => $config['sess_cookie_name'],
    'cookie_name'       => $session_name_desa,
    'cookie_path'       => $config['cookie_path'],
    'cookie_domain'     => $config['cookie_domain'],
    'cookie_secure'     => $config['cookie_secure'],
    'expiration'        => $config['sess_expiration'],
    'match_ip'          => $config['sess_match_ip'],
    'save_path'         => $config['sess_save_path'],
    '_sid_regexp'       => '[0-9a-v]{32}',
);


$class = new CI_Session_files_driver($config);

if (is_php('5.4')) {
    session_set_save_handler($class, true);
} else {
    session_set_save_handler(
        array($class, 'open'),
        array($class, 'close'),
        array($class, 'read'),
        array($class, 'write'),
        array($class, 'destroy'),
        array($class, 'gc')
    );
    register_shutdown_function('session_write_close');
}
session_name($config['cookie_name']);

