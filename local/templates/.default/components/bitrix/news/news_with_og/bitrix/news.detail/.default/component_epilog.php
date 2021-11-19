<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

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
<?
//////////Open Graph//////////
if(!empty($arResult['OG'])){
	$APPLICATION->AddHeadString('<meta property="og:locale" content="ru_RU" />',true);
	$APPLICATION->AddHeadString('<meta property="og:title" content="'.$arResult['OG']['OG_TITLE'].'"/>',true);
	$APPLICATION->AddHeadString('<meta property="og:type" content="article" />',true);
	$APPLICATION->AddHeadString('<meta property="og:description" content="'.$arResult['OG']['OG_DESCRIPTION'].'" />',true);
	$APPLICATION->AddHeadString('<meta property="og:image" content="'.$arResult['OG']['OG_IMAGE'].'">',true);
	$APPLICATION->AddHeadString('<meta property="og:url" content="'.$arResult['OG']['OG_URL'].'" />',true);
	$APPLICATION->AddHeadString('<meta property="og:updated_time" content="'.$arResult['OG']['OG_UPDATED_TIME'].'" />',true);
	$APPLICATION->AddHeadString('<meta name="twitter:card" content="summary">',true);
}
//////////Open Graph//////////
?>


