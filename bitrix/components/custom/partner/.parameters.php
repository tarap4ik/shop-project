<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

if (!Loader::includeModule('iblock'))
    return;

$iblockFilter = array('ACTIVE' => 'Y');

$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);

while ($arr = $rsIBlock->Fetch()) {
    $id = (int)$arr['ID'];
    $arIBlock[$id] = '[' . $id . '] ' . $arr['NAME'];
}

$order = array('sort' => 'asc');
$tmp = 'sort';
$rsUsers = CUser::GetList($order, $tmp);
$arUBlock[0] = '[0] Текущий пользователь';

while ($arr = $rsUsers->Fetch()) {
    $id = (int)$arr['ID'];
    $arUBlock[$id] = '[' . $id . '] ' . $arr['LOGIN'];
}

$arComponentParameters = array(
    "PARAMETERS" => array(
        "CNT_ALL" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("CNT_ALL"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "N",
            "DEFAULT" => null,
        ),
        "CNT_ROW" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("CNT_ROW"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "N",
            "DEFAULT" => null,
        ),
        "CATALOG_IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("CATALOG_IBLOCK_ID"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlock,
            'REFRESH' => 'Y',
        ),
        "PARTNER_IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("PARTNER_IBLOCK_ID"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlock,
            'REFRESH' => 'Y',
        ),
        "PARTNER_OPERATOR" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("PARTNER_OPERATOR"),
            "TYPE" => "LIST",
            "VALUES" => $arUBlock,
            'REFRESH' => 'Y',
        ),
    ),
);
?>