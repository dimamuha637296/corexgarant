<?
define("NO_KEEP_STATISTIC", true); // Не собираем стату по действиям AJAX
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

	global $APPLICATION;
	?><?$APPLICATION->IncludeComponent(
        "bitrix:sale.basket.basket.small",
        "dbBasket_mobile",
        array(
            "PATH_TO_BASKET" => $_REQUEST['basket'],
            "PATH_TO_ORDER" => $_REQUEST['order'],
            "SHOW_DELAY" => "Y",
            "SHOW_NOTAVAIL" => "N",
            "SHOW_SUBSCRIBE" => "N",
            "COMPONENT_TEMPLATE" => "dbBasket_mobile",
            "AJAX_UPD" => "Y",
            "CURRENCY" => $_REQUEST['currency']
        ),
        false
    );

die();
?>