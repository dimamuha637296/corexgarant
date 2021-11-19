<?
define("NO_KEEP_STATISTIC", true); // Не собираем стату по действиям AJAX
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent(
    "bitrix:catalog.compare.list",
    "dbCompare",
    array(
        "ACTION_VARIABLE" => "action",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "COMPARE_URL" => "",
        "DETAIL_URL" => "",
        "IBLOCK_ID" => $_POST['IBLOCK_ID'],
        "IBLOCK_TYPE" => "catalog",
        "NAME" => "",
        "POSITION" => "",
        "POSITION_FIXED" => "",
        "PRODUCT_ID_VARIABLE" => "",
        "COMPONENT_TEMPLATE" => "dbCompare",
        "AREA_CLASS" => "",
        "BUTTON_CLASS" => "",
        "DISABLE_CLASS" => "",
        "AJAX_UPD" => "Y",
    ),
    false
);?>
