<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$idSectionTractors = 12;
?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif?>

<?foreach($arResult["ITEMS"] as $arElement):
$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

//pr($arParams["DISPLAY_LIST_IMG_WIDTH"]);

$arElement["PREVIEW_IMG"] = CFile::ResizeImageGet(
		$arElement["DETAIL_PICTURE"]['ID'],
		array("width" => $arParams["DISPLAY_LIST_IMG_WIDTH"], "height" => $arParams["DISPLAY_LIST_IMG_HEIGHT"]),
		$arParams["TYPE_IMG_THUMB"],
		true
);
$isArgegation = $arParams["IS_AGREGATIONS"] == 'Y' ? true : false;
$bHasPicture = is_array($arElement['PREVIEW_IMG']);
?>
<section class="item col-md-6 col-lg-6 col-sm-6 col-6" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
	<?if($bHasPicture):?>
		<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
			<div class="picture">
				<img class="pic" src="<?=$arElement['PREVIEW_IMG']['src']?>" alt="<?=$arElement['DETAIL_PICTURE']['ALT']?>">
			</div>
		</a>
	<?endif?>
	<h4 class="sub-title"><?=$arElement["NAME"]?></h4>
	<?if(strlen($arElement["PREVIEW_TEXT"]) > 0):
	$arElement["PREVIEW_TEXT"] = cutString($arElement["PREVIEW_TEXT"], 120)
	?>
		<?if($arElement['PREVIEW_TEXT_TYPE'] == 'html'):?>				
			<?=$arElement['PREVIEW_TEXT']?>
		<?else:?>
			<p><?=$arElement['PREVIEW_TEXT']?></p>
		<?endif?>	
	<?endif?>	
	<?if(isset($arElement["PROPERTIES"]["PREWIEW_PROP"]["VALUE"]) && strlen($arElement["PROPERTIES"]["PREWIEW_PROP"]["VALUE"][0]) > 0):?>
		<div class="width">
			<?$i=0;foreach($arElement["PROPERTIES"]["PREWIEW_PROP"]["VALUE"] as $key => $arVal):
				if($i ==2) break;
				if(strlen($arElement["PROPERTIES"]["PREWIEW_PROP"]["DESCRIPTION"][$key]) > 0):$i++;?>
					<div><?=$arVal?> <?=$arElement["PROPERTIES"]["PREWIEW_PROP"]["DESCRIPTION"][$key]?></div>
				<?endif;
			endforeach;?>
		</div>	
	<?endif;?>
	<div class="button more">
		<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
			<span><?=GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL')?></span>
			<i class="pic"></i>
		</a>
	</div>
	<?if($arResult["IBLOCK_SECTION_ID"] == $idSectionTractors):?>
		<div class="add-to-compare">
			<label class="compare" data-addhref="<?echo $arElement["COMPARE_URL"]?>"  data-delhref = "<?=$arElement["DELETE_COMPARE_URL"]?>" onclick="return addToCompare(this, 'list', '<?=GetMessage("CATALOG_IN_COMPARE")?>', '<?=$arElement["DELETE_COMPARE_URL"]?>');" id="catalog_add2compare_link_<?=$arElement['ID']?>">
			<input class="compare-check addtoCompareCheckbox" type="checkbox"/>
				<?=GetMessage('CATALOG_COMPARE')?>
			</label>
		</div>
	<?endif;?>
</section>
<?endforeach?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif?>
<?//pr($arResult);?>
