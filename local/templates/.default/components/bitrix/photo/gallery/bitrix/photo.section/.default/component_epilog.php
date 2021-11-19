<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");
	$this->arResult['JSCORE'][] = 'fx';
	if (!defined('DB_GALLERY_LIST_LOADED'))
	{
		$GLOBALS['APPLICATION']->SetAdditionalCSS('/local/components/db.base/gallery.list.system/style.css');
		$GLOBALS['APPLICATION']->AddHeadScript((SITE_TEMPLATE_PATH."/js/libs/jquery.magnific-popup.min.js"));
		$GLOBALS['APPLICATION']->SetAdditionalCSS((SITE_TEMPLATE_PATH.'/css/libs/magnific-popup.min.css'));
		define('DB_GALLERY_LIST_LOADED', 1);
	}
?>