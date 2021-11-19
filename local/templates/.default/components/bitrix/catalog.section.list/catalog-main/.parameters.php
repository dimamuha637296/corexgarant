<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DB_COUNT_SECTIONS" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('DB_COUNT_SECTIONS'),
		"TYPE" => "STRING",
	),
    "DB_TITLE" => Array(
        "NAME" => GetMessage('DB_TITLE'),
        "TYPE" => "STRING",
        "DEFAULT" => "Каталог",
        "PARENT" => "BASE",
    ),
    "DB_LINK_NAME" => Array(
        "NAME" => GetMessage('DB_LINK_NAME'),
        "TYPE" => "STRING",
        "DEFAULT" => "Перейти в каталог",
        "PARENT" => "BASE",
    ),
    "DB_LINK" => Array(
        "NAME" => GetMessage('DB_LINK'),
        "TYPE" => "STRING",
        "DEFAULT" => "/catalog/",
        "PARENT" => "BASE",
    ),
    "DB_BUTTON" => Array(
        "NAME" => GetMessage('DB_BUTTON'),
        "TYPE" => "STRING",
        "DEFAULT" => "Показать весь каталог",
        "PARENT" => "BASE",
    ),
);
?>