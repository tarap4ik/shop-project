<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $USER;

$partnersId = array();

if ($this->StartResultCache()) {
    $arResult["CNT_ALL"] = $arParams["CNT_ALL"];
    $arResult["CNT_ROW"] = $arParams["CNT_ROW"];
    if ($arParams["PARTNER_OPERATOR"] == 0)
        $arParams["PARTNER_OPERATOR"] = $USER->GetID();

    $arFilter = array("IBLOCK_ID" => $arParams["PARTNER_IBLOCK_ID"], "PROPERTY_OPERATOR" => $arParams["PARTNER_OPERATOR"],);
    $arPartners = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "IBLOCK_ID"));
    while ($ob = $arPartners->Fetch()) {
        $partnersId[] = $ob['ID'];
    }

    if ($partnersId) {
        foreach ($partnersId as $id) {
            $arFilter = array("IBLOCK_ID" => $arParams["CATALOG_IBLOCK_ID"], "PROPERTY_PARTNER" => $id,);
            $arSelectFields = array("ID", "IBLOCK_ID", "ACTIVE", "NAME", "IBLOCK_SECTION_ID", "CODE", "DETAIL_PICTURE");
            $arNavStartParams = array("nPageSize" => $arParams["CNT_ALL"]);
            $arItems = CIBlockElement::GetList(array(), $arFilter, false, $arNavStartParams, $arSelectFields);
            while ($arr = $arItems->Fetch()) {
                $section = CIBlockSection::GetByID($arr["IBLOCK_SECTION_ID"]);
                if ($ar_res = $section->GetNext())
                    $arr['SECTION_PAGE_URL'] = $ar_res['SECTION_PAGE_URL'];
                $arResult['ITEMS'][$id][] = $arr;
            }
            $arFilter = array("IBLOCK_ID" => $arParams["PARTNER_IBLOCK_ID"], "ID" => $id,);
            $arPartners = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, array("ID", "IBLOCK_ID", "NAME"));
            if ($ob = $arPartners->Fetch())
                $arResult["TAB_NAME"][$id] = $ob['NAME'];
        }
    }

    $this->includeComponentTemplate();
}
?>