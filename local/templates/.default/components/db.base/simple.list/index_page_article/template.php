<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if(count($arResult["ITEMS"]) < 1): return false; endif;?>
<div class="teaser gr">
    <div class="title text-center">
        <a href="<?=str_replace("#SITE_DIR#", SITE_DIR, $arResult["LIST_PAGE_URL"]);?>"><span><?=$arResult["NAME"]?></span></a>
    </div>
    <div class="row row-clear">
        <?foreach($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $bHasPicture = $arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem['PREVIEW_IMG']);
            ?>
            <div class="item col-12 col-sm-6 col-md-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <?if($bHasPicture):?>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"];?>">
                        <img src="<?=$arItem['PREVIEW_IMG']['SRC'];?>" alt="<?=$arItem['PREVIEW_IMG']['ALT'];?>" class="img">
                    </a>
                <?endif;?>
                <a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="link"><?=$arItem["~NAME"]?></a>
            </div>
        <?endforeach;?>
    </div>
</div>