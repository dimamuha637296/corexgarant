<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"BTN_TITLE" => Array(
		"NAME" => GetMessage('BTN_TITLE'),
		"TYPE" => "STRING",
		"DEFAULT" => "",
		"PARENT" => "BASE",
	),
	"DISPLAY_IMG_WIDTH" => Array(
			"NAME" => GetMessage('DISPLAY_IMG_WIDTH'),
			"TYPE" => "STRING",
			"DEFAULT" => "150",
			"PARENT" => "DETAIL_SETTINGS",
	),
	"DISPLAY_IMG_HEIGHT" => Array(
			"NAME" => GetMessage('DISPLAY_IMG_HEIGHT'),
			"TYPE" => "STRING",
			"DEFAULT" => "150",
			"PARENT" => "DETAIL_SETTINGS",
	),
	"SHARPEN" => Array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage("DB_BASE_SHARPEN"),
			"TYPE" => "STRING",
			"DEFAULT" => "100",
	),
	"TYPE_IMG_THUMB" => array(
			"PARENT" => "DETAIL_SETTINGS",
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
);
?>