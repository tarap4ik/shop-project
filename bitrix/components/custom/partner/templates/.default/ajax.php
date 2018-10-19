<?
define('STOP_STATISTICS', true);
define('NOT_CHECK_PERMISSIONS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
CModule::IncludeModule('iblock');

$obEl = new CIBlockElement();
$obEl->Update($_REQUEST['id'],array('ACTIVE' => $_REQUEST['status']));