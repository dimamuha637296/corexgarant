<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arTemplateParameters = array(
	"COL_NUM" => Array(
		"NAME" => 'COL_NUM',
		"TYPE" => "STRING",
		"DEFAULT" => "1",
	),
	"COL_MAX" => Array(
		"NAME" => GetMessage("COL_MAX"),
		"TYPE" => "STRING",
		"DEFAULT" => "12",
	),
    "SHOW_NUMBER" => Array(
        "NAME" => GetMessage("SHOW_NUMBER"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "",
    ),
);
?>
