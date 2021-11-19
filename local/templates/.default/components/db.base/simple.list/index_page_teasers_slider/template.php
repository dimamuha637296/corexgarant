<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<?if(count($arResult["ITEMS"]) < 1): return false; endif;?>
<div class="sl-teaser">
	<div class="wrap cursor">
		<div class="slider">

			<?foreach($arResult["ITEMS"] as $arElement):
                if(is_array($arElement['PREVIEW_IMG'])):
				$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="item" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
					<?if($arElement["PROPERTIES"]["HREF"]["VALUE"]):?>
					<a href="<?=$arElement["PROPERTIES"]["HREF"]["VALUE"]?>" class="link">
                    <?else:?>
                        <div class="link">
                    <?endif;?>
						<img src="<?=$arElement['PREVIEW_IMG']['SRC'];?>" alt="<?=$arElement['NAME']?>" class="pic">
						<div class="wrap-i">
							<div class="title"><?=$arElement['NAME']?></div>
							<div class="text"><?=$arElement['~DETAIL_TEXT']?></div>
						</div>
                    <?if($arElement["PROPERTIES"]["HREF"]["VALUE"]):?>
					</a>
                    <?else:?>
                        </div>
                    <?endif;?>
				</div>
			    <?endif;?>
			<?endforeach;?>
		</div>
		<a href="#" class="prev ic-sl-prev"></a>
		<a href="#" class="next ic-sl-next"></a>
	</div>
</div>