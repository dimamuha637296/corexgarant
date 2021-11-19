<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
    "DISPLAY_IMG_WIDTH" => Array(
        "NAME" => GetMessage('DISPLAY_IMG_WIDTH'),
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "PARENT" => "BASE",
    ),
    "DISPLAY_IMG_HEIGHT" => Array(
        "NAME" => GetMessage('DISPLAY_IMG_HEIGHT'),
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "PARENT" => "BASE",
    ),

    "TYPE_IMG_THUMB" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("TYPE_IMG_THUMB"),
        "TYPE" => "LIST",
        "MULTIPLE" => "N",
        "DEFAULT" => "BX_RESIZE_IMAGE_EXACT",
        "VALUES" => (Array(
                "BX_RESIZE_IMAGE_EXACT" => "BX_RESIZE_IMAGE_EXACT",
                "BX_RESIZE_IMAGE_PROPORTIONAL" => "BX_RESIZE_IMAGE_PROPORTIONAL",
                "BX_RESIZE_IMAGE_PROPORTIONAL_ALT" => "BX_RESIZE_IMAGE_PROPORTIONAL_ALT",
            )
            ),
    ),
    "POPUP_IMG_WIDTH" => Array(
        "NAME" => GetMessage('POPUP_IMG_WIDTH'),
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "PARENT" => "BASE",
    ),
    "POPUP_IMG_HEIGHT" => Array(
        "NAME" => GetMessage('POPUP_IMG_HEIGHT'),
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "PARENT" => "BASE",
    ),

	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
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
);
?>
