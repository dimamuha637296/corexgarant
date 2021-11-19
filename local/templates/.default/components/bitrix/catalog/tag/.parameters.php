<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule('iblock'))
	return;

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
	$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "E")))
	{
		$arProperty_LNS[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}

$arTemplateParameters = array(

	"COMPONENT_SHOP" => Array(
		"NAME" => GetMessage("COMPONENT_SHOP"),
		"PARENT" => "BASE",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "",
	),

	"DISPLAY_COMPARE" => Array(
		"NAME" => GetMessage("DISPLAY_COMPARE"),
		"PARENT" => "BASKET",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "",
	),
	"NAME_COMPARE_BTN" => Array(
		"NAME" => GetMessage("NAME_COMPARE_BTN"),
		"PARENT" => "BASKET",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),

	"DETAIL_ACORDEON" => Array(
		"NAME" => GetMessage("DETAIL_ACORDEON"),
		"PARENT" => "BASE",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "",
	),
	"IBLOCK_ID_CATALOG" => Array(
		"NAME" => GetMessage("IBLOCK_ID_CATALOG"),
		"PARENT" => "BASE",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),

	"VIEW_SUBSECTION" => Array(
		"NAME" => GetMessage("VIEW_SUBSECTION"),
		"PARENT" => "BASE",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "",
	),
	"VIEW_SUBSECTION_ITEMS" => Array(
		"NAME" => GetMessage("VIEW_SUBSECTION_ITEMS"),
		"PARENT" => "BASE",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "",
	),
	"DEFAULT_LIST_TEMPLATE" => Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("DEFAULT_LIST_TEMPLATE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"VALUES" => (Array(
			"block" => "block",
			"list" => "list",
			"table" => "table",
		)
		),
	),
	"LIST_ELEMENT_COUNT" => Array(
		"NAME" => GetMessage("LIST_ELEMENT_COUNT"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DEFAULT_IMG" => Array(
		"NAME" => GetMessage("DEFAULT_IMG"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"BTN_NAME" => Array(
		"NAME" => GetMessage("BTN_NAME"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"CATALOG_CURRENCY" => Array(
		"NAME" => GetMessage("CATALOG_CURRENCY"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"BLOCK_IMG_WIDTH" => Array(
		"NAME" => GetMessage("BLOCK_IMG_WIDTH"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"BLOCK_IMG_HEIGHT" => Array(
		"NAME" => GetMessage("BLOCK_IMG_HEIGHT"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),


	"DISPLAY_SECTION_IMG_WIDTH" => Array(
		"NAME" => GetMessage("DISPLAY_SECTION_IMG_WIDTH"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DISPLAY_SECTION_IMG_HEIGHT" => Array(
		"NAME" => GetMessage("DISPLAY_SECTION_IMG_HEIGHT"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),

	"LIST_IMG_WIDTH" => Array(
		"NAME" => GetMessage("LIST_IMG_WIDTH"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"LIST_IMG_HEIGHT" => Array(
		"NAME" => GetMessage("LIST_IMG_HEIGHT"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"TABLE_IMG_WIDTH" => Array(
		"NAME" => GetMessage("TABLE_IMG_WIDTH"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"TABLE_IMG_HEIGHT" => Array(
		"NAME" => GetMessage("TABLE_IMG_HEIGHT"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),


	"TYPE_IMG_THUMB_LIST" => Array(
		"PARENT" => "LIST_SETTINGS",
		"NAME" => GetMessage("TYPE_IMG_THUMB_LIST"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"VALUES" => (Array(
			"BX_RESIZE_IMAGE_EXACT" => "BX_RESIZE_IMAGE_EXACT",
			"BX_RESIZE_IMAGE_PROPORTIONAL" => "BX_RESIZE_IMAGE_PROPORTIONAL",
			"BX_RESIZE_IMAGE_PROPORTIONAL_ALT" => "BX_RESIZE_IMAGE_PROPORTIONAL_ALT",
		)
		),
	),
	"TYPE_IMG_THUMB" => Array(
		"PARENT" => "DETAIL_SETTINGS",
		"NAME" => GetMessage("TYPE_IMG_THUMB"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"VALUES" => (Array(
			"BX_RESIZE_IMAGE_EXACT" => "BX_RESIZE_IMAGE_EXACT",
			"BX_RESIZE_IMAGE_PROPORTIONAL" => "BX_RESIZE_IMAGE_PROPORTIONAL",
			"BX_RESIZE_IMAGE_PROPORTIONAL_ALT" => "BX_RESIZE_IMAGE_PROPORTIONAL_ALT",
		)
		),
	),
	"DETAIL_LONG_TEXT" => Array(
		"NAME" => GetMessage("DETAIL_LONG_TEXT"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"TEXT_DOP_ITEMS" => Array(
		"NAME" => GetMessage("TEXT_DOP_ITEMS"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DETAIL_POPUP_IMG_WIDTH" => Array(
		"NAME" => GetMessage("DETAIL_POPUP_IMG_WIDTH"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DETAIL_POPUP_IMG_HEIGHT" => Array(
		"NAME" => GetMessage("DETAIL_POPUP_IMG_HEIGHT"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),

	"DETAIL_BIG_IMG_WIDTH" => Array(
		"NAME" => GetMessage("DETAIL_BIG_IMG_WIDTH"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DETAIL_BIG_IMG_HEIGHT" => Array(
		"NAME" => GetMessage("DETAIL_BIG_IMG_HEIGHT"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DETAIL_SMALL_IMG_WIDTH" => Array(
		"NAME" => GetMessage("DETAIL_SMALL_IMG_WIDTH"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DETAIL_SMALL_IMG_HEIGHT" => Array(
		"NAME" => GetMessage("DETAIL_SMALL_IMG_HEIGHT"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DETAIL_BRAND_IMG_WIDTH" => Array(
		"NAME" => GetMessage("DETAIL_BRAND_IMG_WIDTH"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DETAIL_BRAND_IMG_HEIGHT" => Array(
		"NAME" => GetMessage("DETAIL_BRAND_IMG_HEIGHT"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	), "DETAIL_BRAND_IMG_HEIGHT" => Array(
		"NAME" => GetMessage("DETAIL_BRAND_IMG_HEIGHT"),
		"PARENT" => "DETAIL_SETTINGS",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DETAIL_PROPERTY_NO_CHAR" => array(
		"PARENT" => "DETAIL_SETTINGS",
		"NAME" => GetMessage("DETAIL_PROPERTY_NO_CHAR"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "Y",
	),


	"SECTIONS_VIEW_MODE" => array(
		"PARENT" => "SECTIONS_SETTINGS",
		"NAME" => GetMessage('CPT_BC_SECTIONS_VIEW_MODE'),
		"TYPE" => "LIST",
		"VALUES" => $arViewModeList,
		"MULTIPLE" => "N",
		"DEFAULT" => "TEXT"
	),

	"PAGINATION_COUNT" => array(
			"PARENT" => "SECTIONS_SETTINGS",
			"NAME" => GetMessage('PAGINATION_COUNT'),
			"TYPE" => "STRING",
			"MULTIPLE" => "Y",
			"DEFAULT" => ""
	),
	"DISPLAY_SECTION_IMG_WIDTH" => array(
		"PARENT" => "SECTIONS_SETTINGS",
		"NAME" => GetMessage('DISPLAY_SECTION_IMG_WIDTH'),
		"TYPE" => "STRING",
		"DEFAULT" => "220"
	),
	"DISPLAY_SECTION_IMG_HEIGHT" => array(
		"PARENT" => "SECTIONS_SETTINGS",
		"NAME" => GetMessage('DISPLAY_SECTION_IMG_HEIGHT'),
		"TYPE" => "STRING",
		"DEFAULT" => "85"
	),
		
	"DISPLAY_LIST_IMG_WIDTH" => array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage('DISPLAY_LIST_IMG_WIDTH'),
			"TYPE" => "STRING",
			"DEFAULT" => "187"
	),
	"DISPLAY_LIST_IMG_HEIGHT" => array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage('DISPLAY_LIST_IMG_HEIGHT'),
			"TYPE" => "STRING",
			"DEFAULT" => "133"
	),
	"DISPLAY_DETAIL_IMG_WIDTH" => array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage('DISPLAY_DETAIL_IMG_WIDTH'),
			"TYPE" => "STRING",
			"DEFAULT" => "610"
	),
	"DISPLAY_DETAIL_IMG_HEIGHT" => array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage('DISPLAY_DETAIL_IMG_HEIGHT'),
			"TYPE" => "STRING",
			"DEFAULT" => "480"
	),
	"DISPLAY_DETAIL_DOP_IMG_WIDTH" => array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage('DISPLAY_DETAIL_DOP_IMG_WIDTH'),
			"TYPE" => "STRING",
			"DEFAULT" => "200"
	),
	"DISPLAY_DETAIL_DOP_IMG_HEIGHT" => array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage('DISPLAY_DETAIL_DOP_IMG_HEIGHT'),
			"TYPE" => "STRING",
			"DEFAULT" => "97"
	),

	"TYPE_IMG_THUMB" => array(
			"PARENT" => "SECTIONS_SETTINGS",
			"NAME" => GetMessage("DB_BASE_TYPE_IMG_THUMB"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"DEFAULT" => "BX_RESIZE_IMAGE_PROPORTIONAL_ALT",
			"VALUES" => (Array(
					"BX_RESIZE_IMAGE_EXACT" => "BX_RESIZE_IMAGE_EXACT",
					"BX_RESIZE_IMAGE_PROPORTIONAL" => "BX_RESIZE_IMAGE_PROPORTIONAL",
					"BX_RESIZE_IMAGE_PROPORTIONAL_ALT" => "BX_RESIZE_IMAGE_PROPORTIONAL_ALT",
			)
			),
	),
	"FILTER_VIEW_MODE" => array(
		"PARENT" => "FILTER_SETTINGS",
		"NAME" => GetMessage('CPT_BC_FILTER_VIEW_MODE'),
		"TYPE" => "LIST",
		"VALUES" => $arFilterViewModeList,
		"DEFAULT" => "VERTICAL"
	)
);



/*
 * parameters set in ADDITIONAL_PARAMS, not in PARENT :(
now impossible
if (array_key_exists('PAGER_TEMPLATE', $arComponentParameters['PARAMETERS']))
{
	$arComponentParameters['PARAMETERS']['PAGER_TEMPLATE']['DEFAULT'] = 'visual';
} */
?>