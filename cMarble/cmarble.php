<?php

/**
 * cMarble - Small PHP Framework Skeleton
 * 
 */

mb_internal_encoding('UTF-8');
define('TIME_START', microtime(true));
define('CM_ACTION', 'cm_action');

define('CM_DIR', dirname(__FILE__).'/');
define('CM_CORE_DIR', CM_DIR.'core/');
define('CONFIG_DIR', APP_DIR.'config/');
define('CONTROLLERS_DIR', APP_DIR.'controllers/');
define('MODELS_DIR', APP_DIR.'models/');
define('VIEWS_DIR', APP_DIR.'views/');
define('HELPERS_DIR', APP_DIR.'helpers/');
define('TMP_DIR', APP_DIR.'tmp/');
define('LOGS_DIR', TMP_DIR.'logs/');
define('LIB_DIR', ROOT_DIR.'lib/');

require dirname(__FILE__) . '/vendor/autoload.php';

require_once CM_CORE_DIR . 'uri.php';
require_once CM_CORE_DIR . 'message.php';
require_once CM_CORE_DIR . 'request.php';
require_once CM_CORE_DIR . 'response.php';
require_once CM_CORE_DIR . 'stream.php';

require_once CM_CORE_DIR . 'exception.php';
require_once CM_CORE_DIR . 'inflector.php';
# require_once CM_CORE_DIR . 'param.php';
require_once CM_CORE_DIR . 'model.php';
# require_once CM_CORE_DIR . 'view.php';
require_once CM_CORE_DIR . 'controller.php';
require_once CM_CORE_DIR . 'dispatcher.php';
