<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult["SECTION"]['ID'] == 0 && $arResult["SECTIONS_COUNT"] > 0):
	LocalRedirect($arResult["SECTIONS"][0]['SECTION_PAGE_URL'], false, '301 Moved permanently');
endif;?>