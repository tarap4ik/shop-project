<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$arResult['PROPERTIES_FOR_PARTNER'] = CIBlockElement::GetProperty($arResult['PROPERTIES']['PARTNER']['LINK_IBLOCK_ID'], $arResult['PROPERTIES']['PARTNER']['VALUE'], array(), array());

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();