<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$arProperties = CIBlockElement::GetProperty($arResult['PROPERTIES']['PARTNER']['LINK_IBLOCK_ID'], $arResult['PROPERTIES']['PARTNER']['VALUE'], array(), array());

while ($property = $arProperties->Fetch()) {
	$name = $property['NAME'];
	if ($property['CODE'] == getMessage("CT_BCE_PROPERTY_CODE")) {
		$user = CUser::GetByID($property['VALUE'])->Fetch();
		$arResult['PROPERTIES_FOR_PARTNER'][$name] = $user['LOGIN'];
	} else {
		$arResult['PROPERTIES_FOR_PARTNER'][$name] = $property['VALUE'];
	}
}

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();