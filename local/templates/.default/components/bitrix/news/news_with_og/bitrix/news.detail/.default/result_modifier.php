<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arParams["DISPLAY_PICTURE_FULL_WIDTH"] != 'Y' && $arParams["DISPLAY_DETAIL_PICTURE"] != "N"){

    $arParams["DISPLAY_DETAIL_IMG_WIDTH"] = isset($arParams["DISPLAY_DETAIL_IMG_WIDTH"]) ? intval($arParams["DISPLAY_DETAIL_IMG_WIDTH"]) : '300';
    $arParams["DISPLAY_DETAIL_IMG_HEIGHT"] = isset($arParams["DISPLAY_DETAIL_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_DETAIL_IMG_HEIGHT"]) : '200';

	if( strlen($arParams["DISPLAY_DETAIL_IMG_HEIGHT"]) > 0 && strlen($arParams["DISPLAY_DETAIL_IMG_WIDTH"]) > 0){
		if(intval($arResult['~DETAIL_PICTURE']) > 0)
		{
			$arResult['PREVIEW_IMG'] = dbResize(array(
                    'FILE_ID' =>  $arResult['~DETAIL_PICTURE'],
                    'TYPE_IMG_THUMB' => $arParams['TYPE_IMG_THUMB'],
                    'WIDTH' => $arParams['DISPLAY_DETAIL_IMG_WIDTH'],
                    'HEIGHT' => $arParams['DISPLAY_DETAIL_IMG_HEIGHT'],
                    'ALT' => $arResult['NAME'],
                    'TITLE' => $arResult['NAME']
                )
            );
		}
	}
}

if(count($arResult['PROPERTIES']['MORE_FILES']['VALUE']) > 0){
	$arResult['MORE_FILES'] = ADBIBlockElement::MORE_FILES($arResult['PROPERTIES']['MORE_FILES']);
}
if(isset($arResult['PROPERTIES']['VIDEO']['VALUE'][0]) && is_array($arResult['PROPERTIES']['VIDEO']['VALUE'][0])){
	$arResult['VIDEO'] = ADBIBlockElement::VIDEO($arResult['PROPERTIES']['VIDEO']);
}

//////////Open Graph//////////
//OG:IMAGE
if($arResult['PREVIEW_IMG']['SRC']){
	$og_image = HTTP_SCHEMA.$_SERVER["SERVER_NAME"].$arResult['PREVIEW_IMG']['SRC'];
}elseif($arResult['~PREVIEW_PICTURE']){
	$tmpImg = dbResize(array(
            'FILE_ID' =>  $arResult['~PREVIEW_PICTURE'],
            'TYPE_IMG_THUMB' => $arParams['TYPE_IMG_THUMB'],
            'WIDTH' => $arParams['DISPLAY_DETAIL_IMG_WIDTH'],
            'HEIGHT' => $arParams['DISPLAY_DETAIL_IMG_HEIGHT'],
            'ALT' => $arResult['NAME'],
            'TITLE' => $arResult['NAME']
        )
    );
	$og_image = HTTP_SCHEMA.$_SERVER["SERVER_NAME"].$tmpImg['SRC'];
}


//OG:DESCRIPTION
if($arResult['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION']){
	$og_descr = $arResult['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION'];
}elseif($arResult['PREVIEW_TEXT']){
	$og_descr = cutString(strip_tags($arResult['PREVIEW_TEXT']), 160);
}elseif($arResult['DETAIL_TEXT']){
	$og_descr = cutString(strip_tags($arResult['DETAIL_TEXT']), 160);
}

//OG:TITLE
if($arResult['IPROPERTY_VALUES']['ELEMENT_META_TITLE']){
	$og_title = $arResult['IPROPERTY_VALUES']['ELEMENT_META_TITLE'];
}elseif($arResult['NAME']){
	$og_title = $arResult['NAME'];
}

//OG:URL
$og_url = HTTP_SCHEMA.$_SERVER["SERVER_NAME"].$arResult['DETAIL_PAGE_URL'];

$arResult['OG'] = array(
	"OG_TITLE" => $og_title,
	"OG_DESCRIPTION" => $og_descr,
	"OG_URL" => $og_url,
	"OG_IMAGE"  => $og_image,
	"OG_UPDATED_TIME"  => date('c',strtotime($arResult["ACTIVE_FROM"]))
);
//////////Open Graph//////////
$cp = $this->__component;
if (is_object($cp))
{
	$cp->SetResultCacheKeys(array('OG'));
}
?>