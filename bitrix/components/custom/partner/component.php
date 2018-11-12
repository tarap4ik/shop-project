<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $USER;

$partnersId = array();
$arSections = array();

if(!isset($arParams["CACHE_TIME"]))
    $arParams["CACHE_TIME"] = 36000000;

if(!isset($arParams["CNT_ALL"]))
    $arParams["CNT_ALL"] = 2;

if(!isset($arParams["CNT_ROW"]))
    $arParams["CNT_ROW"] = 2;

if(!isset($arParams["PARTNER_IBLOCK_ID"])){
    $arBlock = CIBlockElement::GetList(array(), array('IBLOCK_TYPE' => 'partners'));
   if ($arResult = $arBlock->GetNext()) 
   $arParams["PARTNER_IBLOCK_ID"] = $arResult['IBLOCK_ID'];
}

if(!isset($arParams["CATALOG_IBLOCK_ID"])){
   $arBlock = CIBlockElement::GetList(array(), array('IBLOCK_TYPE' => 'catalog'));
   if ($arResult = $arBlock->GetNext()) 
   $arParams["PARTNER_IBLOCK_ID"] = $arResult['IBLOCK_ID'];
}

$arParams['CACHE_GROUPS'] = trim($arParams['CACHE_GROUPS']);
if ('N' != $arParams['CACHE_GROUPS'])
    $arParams['CACHE_GROUPS'] = 'Y';

$arNavStartParams = array("nPageSize" => $arParams["CNT_ALL"],"bShowAll" => false,);
$arNavigation = CDBResult::GetNavParams($arNavStartParams);

if($this->StartResultCache(false, array(serialize($arNavigation), ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups())))){
    $arResult["CNT_ALL"] = $arParams["CNT_ALL"];
    $arResult["CNT_ROW"] = $arParams["CNT_ROW"];

    $arFilter = array("IBLOCK_ID" => $arParams["PARTNER_IBLOCK_ID"], "PROPERTY_OPERATOR" => $arParams["PARTNER_OPERATOR"],);
    $arPartners = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "IBLOCK_ID", "NAME"));
    while ($ob = $arPartners->Fetch()) {
        $partnersId[] = $ob['ID'];
        $arResult["TAB_NAME"][$ob['ID']] = $ob['NAME'];
    }

    if ($partnersId) {
        foreach ($partnersId as $id) {
            $arFilter = array("IBLOCK_ID" => $arParams["CATALOG_IBLOCK_ID"], "PROPERTY_PARTNER" => $id,);
            $arSelectFields = array("ID", "IBLOCK_ID", "ACTIVE", "NAME", "IBLOCK_SECTION_ID", "CODE", "DETAIL_PICTURE");
            $arItems = CIBlockElement::GetList(array(), $arFilter, false, $arNavStartParams, $arSelectFields);
            if($arItems->SelectedRowsCount() > 1)
                $arResult["NAV_STRING"][$id] = $arItems->GetPageNavStringEx($navComponentObject, "", "","Y",$this);
            while ($arr = $arItems->Fetch()) {
                $arSections[] = $arr['SECTION_PAGE_URL'];
                $arResult['ITEMS'][$id][] = $arr;
            }
        }
        $arSectionsList = CIBlockSection::GetList(array(), array('ID' => $arSections), true, array('ID','IBLOCK_ID','SECTION_PAGE_URL'));
        while($Section = $arSectionsList->GetNext())
        {
            $arResult['SECTIONS'][$Section['ID']] = $Section['SECTION_PAGE_URL'];
        }
        
    }

    $this->setResultCacheKeys($arSelectFields);

    $this->includeComponentTemplate();
}
?>