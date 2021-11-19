<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");
	$this->arResult['JSCORE'][] = 'fx';

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