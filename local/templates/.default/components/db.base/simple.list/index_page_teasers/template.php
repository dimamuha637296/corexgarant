<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if(count($arResult["ITEMS"]) < 1): return false; endif;?>
<div class="teaser_2">
    <div class="row row-clear js-height">
        <?$i=0;foreach($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $bHasPicture = $arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem['PREVIEW_IMG']);
            ?>
            <div class="item col-12 col-sm-6 col-lg-3 color-<?=$i?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="#">
                    <div class="wrap js-trg">
                        <?if($bHasPicture):?>
                            <div class="pic">
                                <img src="<?=$arItem['PREVIEW_IMG']['SRC'];?>" alt="<?=$arItem['PREVIEW_IMG']['ALT'];?>" class="img">
                            </div>
                        <?endif?>
                        <div class="title"><?=$arItem["~NAME"]?></div>
                        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N"):?>
                            <?if(strlen($arItem["PREVIEW_TEXT"]) > 0):?>
                                <div class="text"><?=$arItem["~PREVIEW_TEXT"]?></div>
                            <?endif;?>
                        <?endif?>
                    </div>
                </a>
            </div>
            <?$i++;endforeach;?>
    </div>
</div>