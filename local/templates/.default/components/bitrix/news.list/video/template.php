<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?$arResult['CNT'] = count($arResult['ITEMS']) - 1;
if ($arResult['CNT'] < 0)
	return;
$arParams['COLUM_MAX'] = 20;
?>
<div class="b-video">
    <?foreach($arResult["ITEMS"] as $key => $arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $bHasPicture = is_array($arElement['PREVIEW_IMG']);
	?>
        <div class="list" id="video-<?=$arElement["ID"]?>" >
            <div class="row" id="<?=$this->GetEditAreaId($arElement['ID']);?>" >
				<?if($arElement['PROPERTIES']['VIDEO_HREF']['~VALUE']):?>
				<div class="item col-12 col-lg-6" >
					<?//pr($arElement['PROPERTIES']['VIDEO_WIDTH'])?>
					<iframe
							height="<?=$arElement['PROPERTIES']['VIDEO_HEIGHT']['~VALUE']?$arElement['PROPERTIES']['VIDEO_HEIGHT']['~VALUE']:'345'?>"
							class="video_size" src="<?=$arElement['PROPERTIES']['VIDEO_HREF']['~VALUE']?>">

					</iframe>
				</div>
				<?endif;?>
				<div class="descr col-12 col-lg-6" id="collapse-<?=$arElement['ID']?>">
				   <?if($arParams["DISPLAY_NAME"]!="N" && $arElement["NAME"]):?>
						<div class="title h3"><?=$arElement["~NAME"]?></div>
					<?endif;?>
					<div class="text">
						<?if(strlen($arElement["PREVIEW_TEXT"]) > 0):?>
							<?if($arElement['PREVIEW_TEXT_TYPE'] == 'html'):?><?=$arElement["PREVIEW_TEXT"]?><?else:?><p><?=$arElement["PREVIEW_TEXT"]?></p><?endif;?>
						<?endif;?>
					</div>
				</div>
            </div>
        </div>
    <?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
