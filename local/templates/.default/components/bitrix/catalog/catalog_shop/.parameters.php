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
    "DISPLAY_VIEW_LIST" => Array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DISPLAY_VIEW_LIST"),
        "TYPE" => "LIST",
        "MULTIPLE" => "Y",
        "DEFAULT" => "block",
        "VALUES" => (Array(
            "block" => "block",
            "list" => "list",
            "table" => "table",
        )
        ),
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
    "DISPLAY_SORT_LIST" => Array(
        "NAME" => GetMessage("DISPLAY_SORT_LIST"),
        "PARENT" => "LIST_SETTINGS",
        "TYPE" => "LIST",
        "MULTIPLE" => "Y",
        "DEFAULT" => "SORT",
        "VALUES" => (Array(
            "SORT" => "Сортировка",
            "NAME" => "Название",
            "PRICE" => "Цена",
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

	"FILTER_VIEW_MODE" => array(
		"PARENT" => "FILTER_SETTINGS",
		"NAME" => GetMessage('CPT_BC_FILTER_VIEW_MODE'),
		"TYPE" => "LIST",
		"VALUES" => $arFilterViewModeList,
		"DEFAULT" => "VERTICAL"
	),
    "IBLOCK_ID_TAGS" => Array(
        "NAME" => GetMessage("IBLOCK_ID_TAGS"),
        "PARENT" => "BASE",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ),
    "TAGS_BLOCK_TITLE" => Array(
        "NAME" => GetMessage("TAGS_BLOCK_TITLE"),
        "PARENT" => "BASE",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ),
);

$arTemplateParameters["DISPLAY_PREVIEW_TEXT"] = array(
    "PARENT" => "SECTIONS_SETTINGS",
    "NAME" => GetMessage("DISPLAY_PREVIEW_TEXT"),
    "TYPE" => "CHECKBOX",
    "REFRESH" => "Y",
    "DEFAULT" => "N"
);
$arTemplateParameters["DISPLAY_SECTION_IMG"] = array(
    "PARENT" => "SECTIONS_SETTINGS",
    "NAME" => GetMessage("DISPLAY_SECTION_IMG"),
    "TYPE" => "CHECKBOX",
    "REFRESH" => "Y",
    "DEFAULT" => "N"
);
if($arCurrentValues["DISPLAY_SECTION_IMG"] == "Y") {
    $arTemplateParameters["SECTION_IMG_WIDTH"] = array(
        "PARENT" => "SECTIONS_SETTINGS",
        "NAME" => GetMessage("DISPLAY_SECTION_IMG_WIDTH"),
        "TYPE" => "STRING",
        "DEFAULT" => "220"
    );
    $arTemplateParameters["SECTION_IMG_HEIGHT"] = array(
        "PARENT" => "SECTIONS_SETTINGS",
        "NAME" => GetMessage("DISPLAY_SECTION_IMG_HEIGHT"),
        "TYPE" => "STRING",
        "DEFAULT" => "85"
    );
    $arTemplateParameters["SECTION_TYPE_IMG_THUMB"] = array(
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
    );
}



$arTemplateParameters["VIEW_SUBSECTION"] = array(
    "PARENT" => "SECTIONS_SETTINGS",
    "NAME" => GetMessage("VIEW_SUBSECTION"),
    "TYPE" => "CHECKBOX",
    "REFRESH" => "Y",
    "DEFAULT" => "N"
);
$arTemplateParameters["VIEW_SUBSECTION_ITEMS"] = array(
    "PARENT" => "SECTIONS_SETTINGS",
    "NAME" => GetMessage("VIEW_SUBSECTION_ITEMS"),
    "TYPE" => "CHECKBOX",
    "REFRESH" => "Y",
    "DEFAULT" => "N"
);
if($arCurrentValues["VIEW_SUBSECTION"] == "Y" || $arCurrentValues["VIEW_SUBSECTION_ITEMS"] == "Y") {

    $arTemplateParameters["VIEW_SUBSECTION_IMG"] = array(
        "PARENT" => "SECTIONS_SETTINGS",
        "NAME" => GetMessage("VIEW_SUBSECTION_IMG"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
        "REFRESH" => "Y"
    );

    if($arCurrentValues["VIEW_SUBSECTION_IMG"] == "Y") {
        $arTemplateParameters["SUBSECTION_IMG_WIDTH"] = array(
            "PARENT" => "SECTIONS_SETTINGS",
            "NAME" => GetMessage("SUBSECTION_IMG_WIDTH"),
            "TYPE" => "STRING",
            "DEFAULT" => "220"
        );
        $arTemplateParameters["SUBSECTION_IMG_HEIGHT"] = array(
            "PARENT" => "SECTIONS_SETTINGS",
            "NAME" => GetMessage("SUBSECTION_IMG_WIDTH"),
            "TYPE" => "STRING",
            "DEFAULT" => "150"
        );
        $arTemplateParameters["SUBSECTION_TYPE_IMG_THUMB"] = array(
            "PARENT" => "SECTIONS_SETTINGS",
            "NAME" => GetMessage("SUBSECTION_TYPE_IMG_THUMB"),
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "DEFAULT" => "BX_RESIZE_IMAGE_PROPORTIONAL_ALT",
            "VALUES" => (Array(
                "BX_RESIZE_IMAGE_EXACT" => "BX_RESIZE_IMAGE_EXACT",
                "BX_RESIZE_IMAGE_PROPORTIONAL" => "BX_RESIZE_IMAGE_PROPORTIONAL",
                "BX_RESIZE_IMAGE_PROPORTIONAL_ALT" => "BX_RESIZE_IMAGE_PROPORTIONAL_ALT",
            )
            ),
        );
    }
}







$arTemplateParameters["DETAIL_TAB"] = array(
    "PARENT" => "DETAIL_SETTINGS",
    "NAME" => GetMessage("DETAIL_TAB"),
    "TYPE" => "CHECKBOX",
    "DEFAULT" => "Y",
);


$arTemplateParameters["DETAIL_AVAILABILITY"] = array(
    "PARENT" => "DETAIL_SETTINGS",
    "NAME" => GetMessage("DETAIL_AVAILABILITY"),
    "TYPE" => "CHECKBOX",
    "REFRESH" => "Y",
    "DEFAULT" => "Y"
);

if($arCurrentValues["DETAIL_AVAILABILITY"] == "Y") {
    $arTemplateParameters["DETAIL_AVAILABILITY_YES"] = array(
        "PARENT" => "DETAIL_SETTINGS",
        "NAME" => GetMessage("DETAIL_AVAILABILITY_YES"),
        "TYPE" => "STRING",
        "DEFAULT" => GetMessage('DETAIL_AVAILABILITY_YES_VALUE')
    );
    $arTemplateParameters["DETAIL_AVAILABILITY_NO"] = array(
        "PARENT" => "DETAIL_SETTINGS",
        "NAME" => GetMessage("DETAIL_AVAILABILITY_NO"),
        "TYPE" => "STRING",
        "DEFAULT" => GetMessage('DETAIL_AVAILABILITY_NO_VALUE')
    );
}

$arTemplateParameters["DETAIL_BRAND"] = array(
    "PARENT" => "DETAIL_SETTINGS",
    "NAME" => GetMessage("DETAIL_BRAND"),
    "TYPE" => "CHECKBOX",
    "REFRESH" => "Y",
    "DEFAULT" => "Y"
);

if($arCurrentValues["DETAIL_BRAND"] == "Y") {
    $arTemplateParameters["DETAIL_BRAND_LINK_TEXT"] = array(
        "PARENT" => "DETAIL_SETTINGS",
        "NAME" => GetMessage("DETAIL_BRAND_LINK_TEXT"),
        "TYPE" => "STRING",
        "DEFAULT" => GetMessage("DETAIL_BRAND_LINK_TEXT_VALUE")
    );
    $arTemplateParameters["DETAIL_BRAND_IMG_WIDTH"] = array(
        "PARENT" => "DETAIL_SETTINGS",
        "NAME" => GetMessage("DETAIL_BRAND_IMG_WIDTH"),
        "TYPE" => "STRING",
        "DEFAULT" => "132"
    );
    $arTemplateParameters["DETAIL_BRAND_IMG_HEIGHT"] = array(
        "PARENT" => "DETAIL_SETTINGS",
        "NAME" => GetMessage("DETAIL_BRAND_IMG_HEIGHT"),
        "TYPE" => "STRING",
        "DEFAULT" => "35"
    );
}

$arTemplateParameters["DETAIL_LONG_TEXT"] = array(
    "PARENT" => "DETAIL_SETTINGS",
    "NAME" => GetMessage("DETAIL_LONG_TEXT"),
    "TYPE" => "STRING",
    "DEFAULT" => "250",
);

$arTemplateParameters["USE_DETAIL_TITLE_RELATED"] = array(
    "PARENT" => "DETAIL_SETTINGS",
    "NAME" => GetMessage("USE_DETAIL_TITLE_RELATED"),
    "TYPE" => "CHECKBOX",
    "REFRESH" => "Y",
    "DEFAULT" => "Y",
);

if($arCurrentValues["USE_DETAIL_TITLE_RELATED"] == "Y") {
    $arTemplateParameters["DETAIL_TITLE_RELATED"] = array(
        "PARENT" => "DETAIL_SETTINGS",
        "NAME" => GetMessage("DETAIL_TITLE_RECOMMEND"),
        "TYPE" => "STRING",
        "DEFAULT" => GetMessage("DETAIL_TITLE_RELATED_VALUE")
    );
}

$arTemplateParameters["USE_DETAIL_TITLE_RECOMMEND"] = array(
    "PARENT" => "DETAIL_SETTINGS",
    "NAME" => GetMessage("USE_DETAIL_TITLE_RECOMMEND"),
    "TYPE" => "CHECKBOX",
    "REFRESH" => "Y",
    "DEFAULT" => "Y",
);

if($arCurrentValues["USE_DETAIL_TITLE_RECOMMEND"] == "Y") {
    $arTemplateParameters["DETAIL_TITLE_RECOMMEND"] = array(
        "PARENT" => "DETAIL_SETTINGS",
        "NAME" => GetMessage("DETAIL_TITLE_RECOMMEND"),
        "TYPE" => "STRING",
        "DEFAULT" => GetMessage("DETAIL_TITLE_RECOMMEND_VALUE")
    );
}

///BASKET



$arTemplateParameters["USE_QUANTITY_FOR_ORDER"] = array(
    "PARENT" => "BASKET",
    "NAME" => "Учитывать остатки для отображения кнопки купить",
    "TYPE" => "STRING",
    "TYPE" => "CHECKBOX",
    "REFRESH" => "Y",
    "DEFAULT" => "Y",
);

$arTemplateParameters["BTN_MESS_BUY"] = array(
    "PARENT" => "BASKET",
    "NAME" => GetMessage('BTN_MESS_BUY'),
    "TYPE" => "STRING",
    "DEFAULT" => GetMessage('BTN_MESS_BUY_VALUE'),
);
$arTemplateParameters["BTN_PREORDER"] = array(
    "PARENT" => "BASKET",
    "NAME" => GetMessage('BTN_PREORDER'),
    "TYPE" => "STRING",
    "DEFAULT" => GetMessage('BTN_PREORDER_VALUE')
);
$arTemplateParameters["BTN_NO_AVAILABLE"] = array(
    "PARENT" => "BASKET",
    "NAME" => GetMessage('BTN_NO_AVAILABLE'),
    "TYPE" => "STRING",
    "DEFAULT" => GetMessage('BTN_NO_AVAILABLE_VALUE')
);


$arTemplateParameters["BUY_ONE_CLICK_SECTION"] = array(
    "PARENT" => "BASKET",
    "NAME" => GetMessage("USE_BUY_ONE_CLICK"),
    "TYPE" => "CHECKBOX",
    "REFRESH" => "Y",
    "DEFAULT" => "Y",
);
if($arCurrentValues["BUY_ONE_CLICK_SECTION"] == "Y") {
    $arTemplateParameters["BTN_MESS_BUY_ONE_KLICK"] = array(
        "PARENT" => "BASKET",
        "NAME" => GetMessage("BTN_BUY_ONE_CLICK"),
        "TYPE" => "STRING",
        "DEFAULT" => "Купить в 1 клик"
    );
}

if($arCurrentValues["USE_COMPARE"]=="Y") {
    $arTemplateParameters["NAME_COMPARE_BTN"] = array(
        "PARENT" => "COMPARE_SETTINGS",
        "NAME" => GetMessage("NAME_COMPARE_BTN"),
        "TYPE" => "STING",
    );
}








/*
 * parameters set in ADDITIONAL_PARAMS, not in PARENT :(
now impossible
if (array_key_exists('PAGER_TEMPLATE', $arComponentParameters['PARAMETERS']))
{
	$arComponentParameters['PARAMETERS']['PAGER_TEMPLATE']['DEFAULT'] = 'visual';
} */
?>