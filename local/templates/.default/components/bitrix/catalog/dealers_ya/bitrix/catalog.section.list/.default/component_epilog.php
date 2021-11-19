<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!defined('BX_GMAP_SCRIPT_LOADED'))
{
	CUtil::InitJSCore();
	
	if ($arParams['DEV_MODE'] != 'Y')
	{
		$APPLICATION->AddHeadString('<script src="http://maps.google.com/maps/api/js?sensor=false&language='.LANGUAGE_ID.'" charset="utf-8"></script>');
		
		define('BX_GMAP_SCRIPT_LOADED', 1);
	}
}
?>