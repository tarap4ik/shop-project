<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Партнерский кабинет");
?><?$APPLICATION->IncludeComponent(
	"custom:partner", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"CNT_ALL" => "2",
		"CNT_ROW" => "2",
		"CATALOG_IBLOCK_ID" => "2",
		"PARTNER_IBLOCK_ID" => "4",
		"PARTNER_OPERATOR" => $USER->GetID(),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_GROUPS" => "Y"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>