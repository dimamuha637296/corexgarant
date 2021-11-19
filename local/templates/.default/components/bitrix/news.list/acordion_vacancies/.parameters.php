<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"SHOW_SECTIONS" => Array(
		"NAME" =>GetMessage('SHOW_SECTIONS'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "",
		"PARENT" => "BASE",
	),

	"OPEN_FIRST" => Array(
		"NAME" =>GetMessage('T_IBLOCK_OPEN_FIRST'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
);
?>
