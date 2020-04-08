<?php

define('PATH_APP', '/app/');
define('ROOTS',PATH_APP.'config/roots.php');

define('PATH_CONTROLLERS', PATH_APP . 'controllers/');
define('PATH_MODELS', PATH_APP . 'models/');

define('FORM_CONTROLLER', PATH_CONTROLLERS . 'FormController.php');
define('FORM_MODEL', PATH_MODELS . 'Form.php');

define('AUTHORIZATION_CONTROLLER', PATH_CONTROLLERS . 'AuthorizationController.php');
define('AUTHORIZATION_MODEL', PATH_MODELS . 'Authorization.php');

define('MESSENGER_CONTROLLER',PATH_CONTROLLERS.'MessengerController.php');
define('MESSENGER_MODEL',PATH_MODELS.'Messenger.php');

define('PATH_BASE', '/base/');
define('USER_BASE', PATH_BASE . 'userBase.json');
define('MESSAGE_BASE', PATH_BASE . 'messageBase.json');

define('PATH_FORM','/public/form/');
define('CHAT_FORM','chatForm.php');