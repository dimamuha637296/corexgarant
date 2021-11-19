<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();




// dop price
if($arResult["ITEMS"]["AnDelCanBuy"] && count($arResult["ITEMS"]["AnDelCanBuy"])>0){

	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arId){
		$arResult["ITEM_ID"][] = $arId["PRODUCT_ID"];
	}

	$arSelect = Array("ID","IBLOCK_ID", "PROPERTY_OLD_PRICE");
	$arFilter = Array(

		"ID"=> $arResult["ITEM_ID"],
		"!PROPERTY_OLD_PRICE"=> false,

	);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($arField = $res->GetNext())
	{
		$arResult["SALE_PRICE"][$arField["ID"]] = SaleFormatCurrency(str_replace(",",".",$arField["PROPERTY_OLD_PRICE_VALUE"]), $arResult["ITEMS"]["AnDelCanBuy"][0]["CURRENCY"]);
	}

}

