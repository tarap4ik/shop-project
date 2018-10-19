<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); 	
global $USER;

$arFilter = array( "IBLOCK_ID" => 4, "PROPERTY_OPERATOR" => $USER->GetID(), ); 
$arPartners = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, Array());
while($ob = $arPartners->GetNextElement())
{
	$partnersId[] += $ob->GetFields()['ID'];
}

if($partnersId){
	foreach ($partnersId as $id) {
		$arFilter = array( "IBLOCK_ID" => 2, "PROPERTY_PARTNER" => $id, ); 
		$arItems = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, Array());
		while ($arr = $arItems->Fetch())
		{
			$arResult['ITEMS'][$id][]=$arr;
		}
	}
}

$arResult["CNT_ALL"] = $arParams["CNT_ALL"];
$arResult["CNT_ROW"] = $arParams["CNT_ROW"];

$this -> includeComponentTemplate();

?>