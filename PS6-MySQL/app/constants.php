<?php

define('PATH_APP', '/app/');
define('ROOTS', PATH_APP . 'config/roots.php');
define('DB_SETTING', PATH_APP . 'config/dbConfig.php');

define('PATH_CONTROLLERS', PATH_APP . 'controllers/');
define('PATH_MODELS', PATH_APP . 'models/');

define('FORM_CONTROLLER', PATH_CONTROLLERS . 'FormController.php');
define('FORM_MODEL', PATH_MODELS . 'Form.php');

define('AUTHORIZATION_CONTROLLER', PATH_CONTROLLERS . 'AuthorizationController.php');
define('AUTHORIZATION_MODEL', PATH_MODELS . 'Authorization.php');

define('MESSENGER_CONTROLLER', PATH_CONTROLLERS . 'MessengerController.php');
define('MESSENGER_MODEL', PATH_MODELS . 'Messenger.php');

define('DATABASE_CONNECTION','DatabaseConnection.php');

define('PATH_FORM', PATH_APP.'/View/');
define('CHAT_FORM', 'chatForm.php');