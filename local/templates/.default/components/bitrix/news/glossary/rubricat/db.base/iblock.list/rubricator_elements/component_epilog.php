<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");
	$this->arResult['JSCORE'][] = 'fx';

	$tmpArr = $arResult['SECTION']['PATH'];
	$arResult['CUR_SECTION'] = array_pop($tmpArr);
	 $GLOBALS['APPLICATION']->AddChainItem($arResult['CUR_SECTION']['NAME'], $GLOBALS['APPLICATION']->GetCurPage(false, false));
?>
<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y"):?>
		<?$APPLICATION->IncludeComponent(
			"db.base:share", ".default", 
			array(),
			false, array('HIDE_ICONS' => 'Y')
		);
		?>
	<?endif;?>