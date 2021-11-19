<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/*$arTemplateParameters = array(
    "CURRENCY" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_CURRENCY"),
        "TYPE" => "STRING",
        "DEFAULT" => "BYR",
        "MULTIPLE" => "N",
    ),
    "AREA_CLASS" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_AREA_CLASS"),
        "TYPE" => "STRING",
        "DEFAULT" => "catalog-item",
        "MULTIPLE" => "N",
    ),
    "BUTTON_CLASS" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_BUTTON_CLASS"),
        "TYPE" => "STRING",
        "DEFAULT" => "btn-buy",
        "MULTIPLE" => "N",
    ),
    "BUTTON_TEXT" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_BUTTON_TEXT"),
        "TYPE" => "STRING",
        "DEFAULT" => "Уже в корзине",
        "MULTIPLE" => "N",
    ),
    "DISABLE_CLASS" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_DISABLE_CLASS"),
        "TYPE" => "STRING",
        "MULTIPLE" => "N",
        "DEFAULT" => "disabled",
    ),
    "QUANTITY_ACTIVATE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_QUANTITY_ACTIVATE"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => 'Y',
        "REFRESH" => "Y",
    ),
);
if($arCurrentValues["QUANTITY_ACTIVATE"] == 'Y'){
    $arTemplateParameters['QUANTITY_AREA_CLASS'] = array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_QUANTITY_AREA_CLASS"),
        "TYPE" => "STRING",
        "MULTIPLE" => "N",
        "DEFAULT" => "catalog-btn-counter",
    );
    $arTemplateParameters['DB_QUANTITY_CLASS'] = array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_QUANTITY_CLASS"),
        "TYPE" => "STRING",
        "MULTIPLE" => "N",
        "DEFAULT" => "quantity",
    );
}else{
    unset($arTemplateParameters["DB_QUANTITY_AREA_CLASS"]);
    unset($arTemplateParameters["DB_QUANTITY_CLASS"]);
}*/

/*$arTemplateParameters['FLY_ACTIVATE'] = array(
    "PARENT" => "BASE",
    "NAME" => GetMessage("DB_FLY_ACTIVATE"),
    "TYPE" => "CHECKBOX",
    "DEFAULT" => 'N',
    "REFRESH" => "Y",
);
if($arCurrentValues["FLY_ACTIVATE"] == 'Y'){
    $arTemplateParameters['IMAGE_CLASS'] = array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_IMAGE_CLASS"),
        "TYPE" => "STRING",
        "MULTIPLE" => "N",
        "DEFAULT" => "main-image",
    );
    $arTemplateParameters['TARGET_CLASS'] = array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_TARGET_CLASS_COMPARE"),
        "TYPE" => "STRING",
        "MULTIPLE" => "N",
        "DEFAULT" => "basket-header",
    );
}else{
    unset($arTemplateParameters["IMAGE_CLASS"]);
}*/
?>
