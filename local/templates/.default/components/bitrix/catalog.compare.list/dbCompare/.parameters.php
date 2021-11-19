<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arTemplateParameters = array(
    "AREA_CLASS" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_AREA_CLASS_COMPARE"),
        "TYPE" => "STRING",
        "DEFAULT" => "catalog-item",
        "MULTIPLE" => "N",
    ),
    "BUTTON_CLASS" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_BUTTON_CLASS_COMPARE"),
        "TYPE" => "STRING",
        "DEFAULT" => "btn-info",
        "MULTIPLE" => "N",
    ),
    "DISABLE_CLASS" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_DISABLE_CLASS_COMPARE"),
        "TYPE" => "STRING",
        "MULTIPLE" => "N",
        "DEFAULT" => "disabled",
    ),
    "RESULT_CLOSE_ICON_CLASS" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_RESULT_CLOSE_ICON_CLASS"),
        "TYPE" => "STRING",
        "MULTIPLE" => "N",
        "DEFAULT" => "db_compare_result_close",
    ),
    "FLY_ACTIVATE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("DB_FLY_ACTIVATE"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => 'N',
        "REFRESH" => "Y",
    ),
    "COMPONENT_MOBILE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("COMPONENT_MOBILE"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => 'N',
    ),
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
        "DEFAULT" => "compair-prod",
    );

}else{
    unset($arTemplateParameters["IMAGE_CLASS"]);
}
?>
