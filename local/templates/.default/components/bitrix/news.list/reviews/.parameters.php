<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
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
		
	"DISPLAY_DETAIL_DOP_IMG_WIDTH" => Array(
			"NAME" => GetMessage('DISPLAY_DETAIL_DOP_IMG_WIDTH'),
			"TYPE" => "STRING",
			"DEFAULT" => "150",
			"PARENT" => "DETAIL_SETTINGS",
	),
	"DISPLAY_DETAIL_DOP_IMG_HEIGHT" => Array(
			"NAME" => GetMessage('DISPLAY_DETAIL_DOP_IMG_HEIGHT'),
			"TYPE" => "STRING",
			"DEFAULT" => "150",
			"PARENT" => "DETAIL_SETTINGS",
	),
	"COLUMN_COUNT_FOR_MORE_PHOTOS" => Array(
			"NAME" => GetMessage('COLUMN_COUNT_FOR_MORE_PHOTOS'),
			"TYPE" => "STRING",
			"DEFAULT" => "4",
			"PARENT" => "DETAIL_SETTINGS",
	),
	"COLUMN_COUNT_FOR_MORE_FILES" => Array(
			"NAME" => GetMessage('COLUMN_COUNT_FOR_MORE_FILES'),
			"TYPE" => "STRING",
			"DEFAULT" => "2",
			"PARENT" => "DETAIL_SETTINGS",
	),

);
?>