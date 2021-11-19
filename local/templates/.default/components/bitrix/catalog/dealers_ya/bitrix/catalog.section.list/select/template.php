<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
//echo '<pre>'; print_r($arResult); echo '</pre>';
$countItems =count($arResult["SECTIONS"]);
if ($countItems < 1)
	return;
?>

<div class="b-region country-select">
	<div class="row mb_3">
		<?foreach($arResult["SECTIONS"] as $arSection):
			if($arSection["CODE"] == $arParams["SECTION_CODE_CUR"]):?>
				<span class="col-md-4 col-lg-4 col-sm-4 col-4"><?=$arSection["NAME"]?></span>
			<?else:?>
				<a class="col-md-4 col-lg-4 col-sm-4 col-4" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
			<?endif;?>
		<?endforeach;?>
	</div>
</div>
<?/*/?><pre><?print_r($arResult)?></pre><?//*/?>