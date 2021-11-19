<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => ("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => ("T_IBLOCK_DESC_NEWS_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => ("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => "T_IBLOCK_DESC_NEWS_TEXT",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"TEXT_UNDER_BLOCK" => Array(
		"NAME" => "TEXT_UNDER_BLOCK",
		"TYPE" => "STRING",
		"DEFAULT" => "Y",
	),
	"LINK_TEXT_UNDER_BLOCK" => Array(
		"NAME" => "LINK_FOR_TEXT_UNDER_BLOCK",
		"TYPE" => "STRING",
		"DEFAULT" => "/",
	),
);
?>
