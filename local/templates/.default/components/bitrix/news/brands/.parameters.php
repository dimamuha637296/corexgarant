<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"USE_SHARE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_USE_SHARE"),
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"VALUE" => "Y",
		"DEFAULT" =>"N",
		"REFRESH"=> "Y",
	),
    "TILED_VIEW" => Array(
        "NAME" => GetMessage("TILED_VIEW"),
        "PARENT" => "LIST_SETTINGS",
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
    ),
    "TEXT_DOP_ITEMS" => Array(
        "NAME" => GetMessage("TEXT_DOP_ITEMS"),
        "PARENT" => "DETAIL_SETTINGS",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ),
    "CATALOG_IMG_WIDTH" => Array(
        "NAME" => GetMessage("CATALOG_IMG_WIDTH"),
        "PARENT" => "DETAIL_SETTINGS",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ),
    "CATALOG_IMG_HEIGHT" => Array(
        "NAME" => GetMessage("CATALOG_IMG_HEIGHT"),
        "PARENT" => "DETAIL_SETTINGS",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ),
    "DEFAULT_IMG" => Array(
        "NAME" => GetMessage("DEFAULT_IMG"),
        "PARENT" => "DETAIL_SETTINGS",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ),
);



?>