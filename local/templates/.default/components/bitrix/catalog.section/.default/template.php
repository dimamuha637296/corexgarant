<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
//pr($arResult["URL"]);
//pr($arResult["ITEMS"]);
?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif?>

<?$i=1;foreach($arResult["ITEMS"] as $key => $arElement):
$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));


$arElement["PREVIEW_IMG"] = CFile::ResizeImageGet(
		$arElement["DETAIL_PICTURE"]['ID'],
		array("width" => $arParams["DISPLAY_LIST_IMG_WIDTH"], "height" => $arParams["DISPLAY_LIST_IMG_HEIGHT"]),
		$arParams["TYPE_IMG_THUMB"],
		true
);

$bHasPicture = is_array($arElement['PREVIEW_IMG']);
if($arResult["URL"][$arElement["ID"]] != $arElement["DETAIL_PAGE_URL"]){
	$arElement["DETAIL_PAGE_URL"] = $arResult["URL"][$arElement["ID"]];
}

?>
<section class="item col-md-6 col-lg-6 col-sm-6 col-6 mb_3" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
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
</section>
<?if($i % 2 == '0')
{
	echo '<section class="clear"></section>';
}
 ?>
<?$i++;endforeach?>
<div class="clear"></div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif?>
<?//pr($arResult);?>
