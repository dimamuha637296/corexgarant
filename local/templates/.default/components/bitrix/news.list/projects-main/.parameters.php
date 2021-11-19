<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_IMG_WIDTH" => Array(
			"NAME" => GetMessage('DISPLAY_IMG_WIDTH'),
			"TYPE" => "STRING",
			"DEFAULT" => "290",
			"PARENT" => "BASE",
	),
	"DISPLAY_IMG_HEIGHT" => Array(
			"NAME" => GetMessage('DISPLAY_IMG_HEIGHT'),
			"TYPE" => "STRING",
			"DEFAULT" => "210",
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
    "DB_TITLE" => Array(
        "NAME" => GetMessage('DB_TITLE'),
        "TYPE" => "STRING",
        "DEFAULT" => "Реализованные проекты",
        "PARENT" => "BASE",
    ),
    "DB_LINK_NAME" => Array(
        "NAME" => GetMessage('DB_LINK_NAME'),
        "TYPE" => "STRING",
        "DEFAULT" => "Перейти в галерею проектов",
        "PARENT" => "BASE",
    ),
    "DB_LINK" => Array(
        "NAME" => GetMessage('DB_LINK'),
        "TYPE" => "STRING",
        "DEFAULT" => "/press-room/projects/",
        "PARENT" => "BASE",
    ),
);
?>