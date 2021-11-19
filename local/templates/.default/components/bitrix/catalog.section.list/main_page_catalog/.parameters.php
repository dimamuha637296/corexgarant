<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array(
	"LINE" => GetMessage("CPT_BCSL_VIEW_MODE_LINE"),
	"TEXT" => GetMessage("CPT_BCSL_VIEW_MODE_TEXT"),
	"TILE" => GetMessage("CPT_BCSL_VIEW_MODE_TILE")
);

$arTemplateParameters = array(
	"DB_COUNT_SECTIONS" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('DB_COUNT_SECTIONS'),
		"TYPE" => "STRING",
	),
	"CATALOG_BUTTON" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('CATALOG_BUTTON'),
		"TYPE" => "STRING",
	),

	"CATALOG_TITLE" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('CATALOG_TITLE'),
		"TYPE" => "STRING",
	),
	"CATALOG_DOP_TITLE" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('CATALOG_DOP_TITLE'),
		"TYPE" => "STRING",
	),
	"CATALOG_HREF" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('CATALOG_HREF'),
		"TYPE" => "STRING",
	),

	"VIEW_MODE" => array(
		"PARENT" => "VISUAL",
		"NAME" => GetMessage('CPT_BCSL_VIEW_MODE'),
		"TYPE" => "LIST",
		"VALUES" => $arViewModeList,
		"MULTIPLE" => "N",
		"DEFAULT" => "LINE"
	),
	"SHOW_PARENT_NAME" => array(
		"PARENT" => "VISUAL",
		"NAME" => GetMessage('CPT_BCSL_SHOW_PARENT_NAME'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y"
	),
	"DISPLAY_SECTION_IMG_WIDTH" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('DISPLAY_SECTION_IMG_WIDTH'),
		"TYPE" => "STRING",
		"DEFAULT" => ""
	),
	"DISPLAY_SECTION_IMG_HEIGHT" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('DISPLAY_SECTION_IMG_HEIGHT'),
		"TYPE" => "STRING",
		"DEFAULT" => "Y"
	)
);
?>