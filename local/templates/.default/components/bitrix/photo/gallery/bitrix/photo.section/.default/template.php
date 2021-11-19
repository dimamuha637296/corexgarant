<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?

if (count($arResult['ITEMS']) < 1)
	return;
	
	$arParamsFX = array();
	foreach ($arResult["ITEMS"] as $key => $arElement){
		if(isset($arElement['DETAIL_PICTURE']) && is_array($arElement['DETAIL_PICTURE'])){
		
			$arParamsFX['ITEMS'][] = $arElement['DETAIL_PICTURE']['ID'];
		}
	}

	$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);
	
	switch ($arParams["TYPE_IMG_THUMB"]){
		case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
		default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT;
	}
	



$APPLICATION->IncludeComponent(
		"db.base:gallery.list",
		".default",
		array(
				"IBLOCK_TYPE" => "wys",
				"IBLOCK_ID" => $arResult['ID'],
				"PARENT_SECTION" => $arResult['SECTION_INFO']['ID'],
				"DISPLAY_IMG_WIDTH" => $arParams['DISPLAY_DETAIL_IMG_WIDTH'],
				"DISPLAY_IMG_HEIGHT" => $arParams['DISPLAY_DETAIL_IMG_HEIGHT'],
				"TYPE_IMG_THUMB" => "BX_RESIZE_IMAGE_EXACT",
				"COLUM" => intval($arParams['LINE_ELEMENT_COUNT']) > 0 ? intval($arParams['LINE_ELEMENT_COUNT']) : 4,
				"COUNT" => "999",

				"FILTER_NAME" => "",
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"ITEMS" => $arParamsFX['ITEMS'],
				"DEF_NAME" => $arResult['NAME']
		),
		false, array('HIDE_ICONS' => 'Y')
);
?>
<div class="b-return hide-print">
	<a href="<?=$arResult['LIST_PAGE_URL']?>"><i>&larr;</i> <span><?=GetMessage("T_NEWS_DETAIL_BACK")?></span></a>
</div>
<?/*/?><pre><?print_r($arParamsFX);?></pre><?//*/?>
<?/*/?><pre><?print_r($arResult);?></pre><?//*/?>

