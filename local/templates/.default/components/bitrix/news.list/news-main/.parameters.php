<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
    "DB_TITLE" => Array(
        "NAME" => GetMessage('DB_TITLE'),
        "TYPE" => "STRING",
        "DEFAULT" => "Новости",
        "PARENT" => "BASE",
    ),
    "DB_LINK_NAME" => Array(
        "NAME" => GetMessage('DB_LINK_NAME'),
        "TYPE" => "STRING",
        "DEFAULT" => "Все новости",
        "PARENT" => "BASE",
    ),
    "DB_LINK" => Array(
        "NAME" => GetMessage('DB_LINK'),
        "TYPE" => "STRING",
        "DEFAULT" => "/press-room/news/",
        "PARENT" => "BASE",
    ),
);
?>