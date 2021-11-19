<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock"))
    return;
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
    $arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arTemplateParameters = array(
    "REDIRECT_FIRST_SECTION" => Array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("REDIRECT_FIRST_SECTION"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "",
    ),
    "MAP_HAS_CATEGORIES" => Array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("MAP_HAS_CATEGORIES"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
    ),
    "MAP_HAS_LIST_ELEMENTS" => Array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("MAP_HAS_LIST_ELEMENTS"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
    ),
    "MAP_HAS_CATEGORY_FILTER" => Array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("MAP_HAS_CATEGORY_FILTER"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
    ),
    'MAP_WIDTH' => array(
        'NAME' => GetMessage('MYMS_PARAM_MAP_WIDTH'),
        'TYPE' => 'STRING',
        'DEFAULT' => '600',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
    'MAP_HEIGHT' => array(
        'NAME' => GetMessage('MYMS_PARAM_MAP_HEIGHT'),
        'TYPE' => 'STRING',
        'DEFAULT' => '500',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
    'MAPS_ICON_SRC' => array(
        'NAME' => GetMessage('MAPS_ICON_SRC'),
        'TYPE' => 'STRING',
        'DEFAULT' => '/local/templates/.default/img/map_icon_point.svg',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
    'MAPS_ICON_MAIN_WIDTH' => array(
        'NAME' => GetMessage('MAPS_ICON_MAIN_WIDTH'),
        'TYPE' => 'STRING',
        'DEFAULT' => '38',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
    'MAPS_ICON_MAIN_HEIGHT' => array(
        'NAME' => GetMessage('MAPS_ICON_MAIN_HEIGHT'),
        'TYPE' => 'STRING',
        'DEFAULT' => '48',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
    'MAPS_ICON_CLUSTER_SRC' => array(
        'NAME' => GetMessage('MAPS_ICON_CLUSTER_SRC'),
        'TYPE' => 'STRING',
        'DEFAULT' => '/local/templates/.default/img/map_icon_cluster.svg',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
    'MAPS_ICON_CLUSTER_WIDTH' => array(
        'NAME' => GetMessage('MAPS_ICON_CLUSTER_WIDTH'),
        'TYPE' => 'STRING',
        'DEFAULT' => '50',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
    'MAPS_ICON_CLUSTER_HEIGHT' => array(
        'NAME' => GetMessage('MAPS_ICON_CLUSTER_HEIGHT'),
        'TYPE' => 'STRING',
        'DEFAULT' => '50',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
    'MAPS_ICON_CLUSTER_BIG_SRC' => array(
        'NAME' => GetMessage('MAPS_ICON_CLUSTER_BIG_SRC'),
        'TYPE' => 'STRING',
        'DEFAULT' => '/local/templates/.default/img/map_icon_cluster_big.svg',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
    'MAPS_ICON_CLUSTER_BIG_WIDTH' => array(
        'NAME' => GetMessage('MAPS_ICON_CLUSTER_BIG_WIDTH'),
        'TYPE' => 'STRING',
        'DEFAULT' => '62',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
    'MAPS_ICON_CLUSTER_BIG_HEIGHT' => array(
        'NAME' => GetMessage('MAPS_ICON_CLUSTER_BIG_HEIGHT'),
        'TYPE' => 'STRING',
        'DEFAULT' => '62',
        'PARENT' => 'SECTIONS_SETTINGS',
    ),
);
?>