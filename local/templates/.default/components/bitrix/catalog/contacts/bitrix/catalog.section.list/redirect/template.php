<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/*/?><pre><?print_r($_SESSION);?></pre><?//*/?>
<?/*/?><pre><?print_r($arResult);?></pre><?//*/?>
<?if(array_key_exists('BD_FILTER_CITY_'.SITE_ID, $_SESSION) && intval($_SESSION['BD_FILTER_CITY_'.SITE_ID]) > 0){
		foreach ($arResult["SECTIONS"] as $arSections){
			if($arSections['ID'] == $_SESSION['BD_FILTER_CITY_'.SITE_ID]){
				$strToRedirect = $arSections['SECTION_PAGE_URL'];
			}
		}
	}elseif($arResult["SECTION"]['ID'] == 0 && $arResult["SECTIONS_COUNT"] > 0){
		$strToRedirect = $arResult["SECTIONS"][0]['SECTION_PAGE_URL'];
}
if(strlen($strToRedirect) > 0){
	LocalRedirect($strToRedirect, false, '301 Moved permanently');
}
?>