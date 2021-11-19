<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if(count($arResult["ITEMS"]) < 1): return false; endif;?>
<div class="sl-partners">
	<div class="title-wrap">
		<?if(strlen($arParams["MAIN_TITLE"])>0):?>
			<div class="b-title"><?=$arParams["MAIN_TITLE"]?></div>
		<?endif;?>
		<?if(strlen($arParams["DOP_TITLE"])>0):?>
			<a href="<?=str_replace("#SITE_DIR#", SITE_DIR, $arResult["LIST_PAGE_URL"]);?>" class="b-link"><?=$arParams["DOP_TITLE"]?></a>
		<?endif;?>
	</div>
	<div class="wrap cursor inited-not">
		<div class="slider">
			<?foreach($arResult["ITEMS"] as $arElement):
				$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$bHasPicture = is_array($arElement['PREVIEW_IMG']);
				?>
				<?if($arParams["DISPLAY_PICTURE"]!="N" && $bHasPicture):?>
				<div class="slide" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
					<?if($arElement["PROPERTIES"]["HREF"]["VALUE"]):?>
						<a href="<?=$arElement["PROPERTIES"]["HREF"]["VALUE"]?>" target="_blank" class="link">
							<img class="img" src="<?=$arElement['PREVIEW_IMG']['SRC'];?>" alt="<?=$arElement['PREVIEW_IMG']['ALT']?>" >
						</a>
					<?else:?>
						<span class="link">
							<img class="img" src="<?=$arElement['PREVIEW_IMG']['SRC'];?>" alt="<?=$arElement['PREVIEW_IMG']['ALT']?>" >
						</span>
					<?endif;?>
				</div>
			<?endif;?>
			<?endforeach;?>
		</div>
		<a href="#" class="prev ic-sl-prev"></a>
		<a href="#" class="next ic-sl-next"></a>
	</div>
	
</div>