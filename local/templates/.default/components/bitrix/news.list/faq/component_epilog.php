<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");
if (!defined('DB_FILES_LIST_LOADED'))
{
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/local/components/db.base/fileslist.system/style.css');
	define('DB_FILES_LIST_LOADED', 1);
}
?>