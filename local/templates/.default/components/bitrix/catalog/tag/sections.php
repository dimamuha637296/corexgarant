<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

$obCache = new CPHPCache;
$life_time = 86400*7;
$cache_id = "tag_sectionsDB".$arParams['IBLOCK_ID'];
$cache_path = "/tags_redirect/";

if($obCache->InitCache($life_time, $cache_id, $cache_path)) :
	$vars = $obCache->GetVars();
	$redirect = $vars["REDIRECT_URL"];

else :
	global $CACHE_MANAGER;
	$CACHE_MANAGER->StartTagCache($cache_path);
	$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams['IBLOCK_ID']);

	$arFilter = Array(
		"IBLOCK_ID"=>$arParams['IBLOCK_ID'],
		"ACTIVE"=>"Y"
	);
	$res = CIBlockElement::GetList(true, $arFilter, false,Array("nPageSize"=>1),array("DETAIL_PAGE_URL"));
	while($arFields = $res->GetNext())
	{
		$arResult["REDIRECT_URL"] = $arFields["DETAIL_PAGE_URL"];
	}
	$CACHE_MANAGER->EndTagCache();
	$redirect = $arResult["REDIRECT_URL"];

	if($obCache->StartDataCache()):
		$obCache->EndDataCache(array(
			"REDIRECT_URL" => $redirect
		));

	endif;

endif;

if($redirect){
	LocalRedirect($redirect, false, '301 Moved permanently');
}


?>