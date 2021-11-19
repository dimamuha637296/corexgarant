<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();




__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");

////COMPARE_CODE/////
if (count($arResult['IDS']) > 0 && CModule::IncludeModule('sale'))
{
	$arItemsInCompare = array();
	foreach ($arResult['IDS'] as $ID)
	{
		if (isset(
			$_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$ID]
		))
			$arItemsInCompare[] = $ID;

	}

	if (count($arItemsInCompare) > 0)
	{
		echo '<script type="text/javascript">$(function(){'."\r\n";
		foreach ($arItemsInCompare as $id)
		{
			echo "disableAddToCompare(BX('catalog_add2compare_link_".$id."'), 'list', '".GetMessage("CATALOG_IN_COMPARE")."', '".htmlspecialcharsback($arResult["DELETE_COMPARE_URLS"][$id])."');\r\n";
		}
		echo '})</script>';
	}
}
////COMPARE_CODE/////
?>