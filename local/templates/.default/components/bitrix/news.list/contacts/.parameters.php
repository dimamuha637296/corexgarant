<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
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
	"DISPLAY_NAME" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DISPLAY_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
	),
	"DISPLAY_IMG_WIDTH" => Array(
			"NAME" => GetMessage('DISPLAY_IMG_WIDTH'),
			"TYPE" => "STRING",
			"DEFAULT" => "150",
			"PARENT" => "BASE",
	),
	"DISPLAY_IMG_HEIGHT" => Array(
			"NAME" => GetMessage('DISPLAY_IMG_HEIGHT'),
			"TYPE" => "STRING",
			"DEFAULT" => "150",
			"PARENT" => "BASE",
	),
	"SHARPEN" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("DB_BASE_SHARPEN"),
			"TYPE" => "STRING",
			"DEFAULT" => "100",
	),
	"TYPE_IMG_THUMB" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("DB_BASE_TYPE_IMG_THUMB"),
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
	"COLUM" => Array(
			"NAME" => GetMessage('COLUM'),
			"TYPE" => "STRING",
			"DEFAULT" => "2",
			"PARENT" => "BASE",
	),

);
?>