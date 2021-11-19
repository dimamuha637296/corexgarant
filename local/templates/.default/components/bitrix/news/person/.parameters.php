<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"TILED_VIEW" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("TILED_VIEW"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"REFRESH" => "Y",			
	),

	"DISPLAY_PICTURE" => Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_ELEMENT_NAME" => Array(
		"PARENT" => "BASE", 
		"NAME" => GetMessage("T_IBLOCK_DISPLAY_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),

		


);
if($arCurrentValues["DISPLAY_PICTURE_FULL_WIDTH"] != "Y"){
	
	$arTemplateParameters["DISPLAY_LIST_IMG_WIDTH"] = Array(
			"NAME" => GetMessage('DISPLAY_LIST_IMG_WIDTH'),
			"TYPE" => "STRING",
			"DEFAULT" => "150",
			"PARENT" => "LIST_SETTINGS",
	);
	$arTemplateParameters["DISPLAY_LIST_IMG_HEIGHT"] = Array(
			"NAME" => GetMessage('DISPLAY_LIST_IMG_HEIGHT'),
			"TYPE" => "STRING",
			"DEFAULT" => "150",
			"PARENT" => "LIST_SETTINGS",
	);
	$arTemplateParameters["SHARPEN_LIST"] = Array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("DB_BASE_SHARPEN"),
			"TYPE" => "STRING",
			"DEFAULT" => "100",
	);
	$arTemplateParameters["TYPE_IMG_THUMB_LIST"] = array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("DB_BASE_TYPE_IMG_THUMB_LIST"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"DEFAULT" => "BX_RESIZE_IMAGE_EXACT",
			"VALUES" => (Array(
					"BX_RESIZE_IMAGE_EXACT" => "BX_RESIZE_IMAGE_EXACT",
					"BX_RESIZE_IMAGE_PROPORTIONAL" => "BX_RESIZE_IMAGE_PROPORTIONAL",
					"BX_RESIZE_IMAGE_PROPORTIONAL_ALT" => "BX_RESIZE_IMAGE_PROPORTIONAL_ALT",
			)
			),
	);
	$arTemplateParameters["DISPLAY_DETAIL_IMG_WIDTH"] = Array(
			"NAME" => GetMessage('DISPLAY_DETAIL_IMG_WIDTH'),
			"TYPE" => "STRING",
			"DEFAULT" => "200",
			"PARENT" => "DETAIL_SETTINGS",
	);
	$arTemplateParameters["DISPLAY_DETAIL_IMG_HEIGHT"] = Array(
			"NAME" => GetMessage('DISPLAY_DETAIL_IMG_HEIGHT'),
			"TYPE" => "STRING",
			"DEFAULT" => "200",
			"PARENT" => "DETAIL_SETTINGS",
	);
	$arTemplateParameters["SHARPEN_DETAIL"] = Array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage("DB_BASE_SHARPEN"),
			"TYPE" => "STRING",
			"DEFAULT" => "100",
			"PARENT" => "DETAIL_SETTINGS",
	);
	$arTemplateParameters["TYPE_IMG_THUMB_DETAIL"] = array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage("DB_BASE_TYPE_IMG_THUMB_DETAIL"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"DEFAULT" => "BX_RESIZE_IMAGE_EXACT",
			"VALUES" => (Array(
					"BX_RESIZE_IMAGE_EXACT" => "BX_RESIZE_IMAGE_EXACT",
					"BX_RESIZE_IMAGE_PROPORTIONAL" => "BX_RESIZE_IMAGE_PROPORTIONAL",
					"BX_RESIZE_IMAGE_PROPORTIONAL_ALT" => "BX_RESIZE_IMAGE_PROPORTIONAL_ALT",
			)
			),
	);
	
}


?>