<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock"))
    return;
if(!CModule::IncludeModule("iblock"))
    return;
$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
    $arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}
$arTemplateParameters = array(
	'ICHON_HREF' => array(
		'NAME' => GetMessage('ICHON_HREF'),
		'TYPE' => 'STRING',
		'DEFAULT' => '/local/templates/html/images/gy_map_icon.png',
		'PARENT' => 'ADDITIONAL_SETTINGS',
	),
    'CUR_SECTION_CODE' => array(
		'NAME' => GetMessage('CUR_SECTION_CODE'),
		'TYPE' => 'STRING',
		'DEFAULT' => '={$arResult["VARIABLES"]["SECTION_CODE"]}',
		'PARENT' => 'ADDITIONAL_SETTINGS',
	),
    "IBLOCK_TYPE" => Array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DEALERS_IBLOCK_TYPE"),
        "TYPE" => "LIST",
        "VALUES" => $arTypesEx,
        "DEFAULT" => "news",
        "REFRESH" => "Y",
    ),
    "IBLOCK_ID" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DEALERS_IBLOCK"),
        "TYPE" => "LIST",
        "VALUES" => $arIBlock,
        "MULTIPLE"=>"N",
        'ADDITIONAL_VALUES' => 'Y',

    ),
    "IBLOCK_CATEGORIES" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DEALERS_IBLOCK_CATEGORIES"),
        "TYPE" => "LIST",
        "VALUES" => $arIBlock,
        "MULTIPLE"=>"N",
        'ADDITIONAL_VALUES' => 'Y',

    ),
);
?>