<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); 
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
    ),
);
?>