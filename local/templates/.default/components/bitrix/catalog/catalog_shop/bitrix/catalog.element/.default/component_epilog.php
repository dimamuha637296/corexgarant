<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetPageProperty("HideTitle", "Y");
if($arResult["IMAGES"]){
    $GLOBALS['APPLICATION']->AddHeadScript("/local/templates/.default/js/libs/jquery.carouFredSel-6.2.1.min.js");
    $GLOBALS['APPLICATION']->SetAdditionalCSS(('/local/templates/.default/css/libs/magnific-popup.min.css'));
    $GLOBALS['APPLICATION']->AddHeadScript(("/local/templates/.default/js/libs/jquery.magnific-popup.min.js"));
}
$GLOBALS['APPLICATION']->AddHeadScript(("/local/templates/.default/js/libs/jquery.formstyler.min.js"));
/*
if($arResult["URL"] != $APPLICATION->GetCurPage()){
    LocalRedirect($arResult["URL"], false, '301 Moved permanently');
}

//*/
if($arResult["PROPERTIES"]["IT_TOVAR"]["VALUE"]){
    $GLOBALS["RECOMMEND"] = $arResult["PROPERTIES"]["IT_TOVAR"]["VALUE"];
}

if($arResult["PROPERTIES"]["TEXT_MANAGER"]["VALUE"]){
    $GLOBALS["TEXT_MANAGER"] = $arResult["PROPERTIES"]["TEXT_MANAGER"]["~VALUE"];
}

//////////Open Graph//////////
if(!empty($arResult['OG'])){
    $APPLICATION->SetPageProperty("description", $arResult['OG']['OG_DESCRIPTION']); ///Set Description

    $APPLICATION->AddHeadString('<meta property="og:locale" content="ru_RU" />',true);
    $APPLICATION->AddHeadString('<meta property="og:title" content="'.$arResult['OG']['OG_TITLE'].'"/>',true);
    $APPLICATION->AddHeadString('<meta property="og:type" content="article" />',true);
    $APPLICATION->AddHeadString('<meta property="og:description" content="'.$arResult['OG']['OG_DESCRIPTION'].'" />',true);
    $APPLICATION->AddHeadString('<meta property="og:image" content="'.$arResult['OG']['OG_IMAGE'].'">',true);
    $APPLICATION->AddHeadString('<meta itemprop="image" content="'.$arResult['OG']['OG_IMAGE'].'">',true);
    $APPLICATION->AddHeadString('<meta property="og:url" content="'.$arResult['OG']['OG_URL'].'" />',true);
}
//////////Open Graph//////////

if( $arResult['CAN_URL']){
    $APPLICATION->AddHeadString('<link rel="canonical" href="http://'.$_SERVER["SERVER_NAME"]. $arResult['CAN_URL'].'" />',true);
}
?>

<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
