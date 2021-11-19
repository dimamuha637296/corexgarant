<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//pr($arResult["PROPERTIES"]["CANONICAL"]["VALUE"]);

if($arResult["PROPERTIES"]["CANONICAL"]["VALUE"]){
$APPLICATION->AddHeadString('<link rel="canonical" href="https://'.$_SERVER["SERVER_NAME"].$arResult["PROPERTIES"]["CANONICAL"]["VALUE"].'" />',true);
}




if (!defined('DB_FILES_LIST_LOADED'))
{
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/local/components/db.base/fileslist.system/style.css');
	define('DB_FILES_LIST_LOADED', 1);
}
if (!defined('DB_GALLERY_LIST_LOADED'))
	{
		$GLOBALS['APPLICATION']->SetAdditionalCSS('/local/components/db.base/gallery.list/style.css');
		$GLOBALS['APPLICATION']->AddHeadScript(("/local/templates/.default/js/libs/jquery.magnific-popup.min.js"));
		$GLOBALS['APPLICATION']->SetAdditionalCSS(('/local/templates/.default/css/libs/magnific-popup.min.css'));
		define('DB_GALLERY_LIST_LOADED', 1);
	}
?>