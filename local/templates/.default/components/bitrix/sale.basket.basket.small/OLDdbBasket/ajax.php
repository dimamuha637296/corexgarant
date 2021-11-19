<?
define("NO_KEEP_STATISTIC", true); // Не собираем стату по действиям AJAX
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (isset($_REQUEST["action"]) && !empty($_REQUEST["action"])) {
	$action = $_REQUEST["action"];

	if (function_exists($action)) {
		$action();
	}
}

function checkBasketItem () {
	CModule::IncludeModule("catalog");
	CModule::IncludeModule("sale");

	if (!empty($_SESSION["USER_BASKET_ITEMS"])) {
		echo json_encode($_SESSION["USER_BASKET_ITEMS"]);
	} else {
		$dbBasketItems = CSaleBasket::GetList(array("ID" => "ASC"), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"), false, false, array("ID", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT"));
        unset($_SESSION["USER_BASKET_ITEMS"]);
		while ($arItems = $dbBasketItems->Fetch()) {
			if (!in_array($arItems["ID"], $_SESSION["USER_BASKET_ITEMS"])) {
				$_SESSION["USER_BASKET_ITEMS"][] = $arItems["PRODUCT_ID"];
			}
		}

		echo json_encode($_SESSION["USER_BASKET_ITEMS"]);
	}
}

function addInBasket() {
	if (CModule::IncludeModule("catalog")) {
		CModule::IncludeModule("sale");

		$goods = Add2BasketByProductID($_REQUEST["id"], $_REQUEST["quantity"]);
		if ($goods) {
            $dbBasketItems = CSaleBasket::GetList(array("ID" => "ASC"), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"), false, false, array("ID", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT"));
            unset($_SESSION["USER_BASKET_ITEMS"]);
            while ($arItems = $dbBasketItems->Fetch()) {
                if (!in_array($arItems["ID"], $_SESSION["USER_BASKET_ITEMS"])) {
                    $_SESSION["USER_BASKET_ITEMS"][] = $arItems["PRODUCT_ID"];
                }
            }
			updateBasket();
		} else {
			echo "ERROR";
		}
	}
}


function updateBasket() {
	global $APPLICATION;
	?><?$APPLICATION->IncludeComponent(
        "bitrix:sale.basket.basket.small",
        "dbBasket",
        array(
            "PATH_TO_BASKET" => $_REQUEST['basket'],
            "PATH_TO_ORDER" => $_REQUEST['order'],
            "SHOW_DELAY" => "Y",
            "SHOW_NOTAVAIL" => "N",
            "SHOW_SUBSCRIBE" => "N",
            "COMPONENT_TEMPLATE" => "dbBasket",
            "AREA_CLASS" => "",
            "BUTTON_CLASS" => "",
            "DISABLE_CLASS" => "",
            "QUANTITY_AREA_CLASS" => "",
            "QUANTITY_CLASS" => "",
            "AJAX_UPD" => "Y",
            "CURRENCY" => $_REQUEST['currency']
        ),
        false
    );
}
die();
?>