<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if(count($arResult["ITEMS"]) < 1): return false; endif;?>
<div class="services">
    <div class="title-wrap">
        <div class="b-title"><?=($arParams["BLOCK_TITLE"]?$arParams["BLOCK_TITLE"]:$arResult["NAME"])?></div>
        <?if(strlen($arParams["DOP_TITLE"])>0):?>
            <a href="<?=str_replace("#SITE_DIR#", SITE_DIR, $arResult["LIST_PAGE_URL"]);?>" class="b-link"><?=$arParams["DOP_TITLE"]?></a>
        <?endif;?>
    </div>
    <div class="row">
        <?$i=0;foreach($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $bHasPicture = $arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem['PREVIEW_IMG']);
            ?>
            <div class="item col-lg-3 col-md-4 col-sm-4 col-12<?$i === 3 ? print ' hidden-md hidden-sm' : ''?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="link">
                    <img src="<?=$arItem['PREVIEW_IMG']['SRC'];?>" alt="<?=$arItem["NAME"]?>" class="pic">
                    <div class="wrap">
                        <div class="title"><?=$arItem["~NAME"]?></div>
                        <div class="text">Разработка и продвижение сайта</div>
                    </div>
                </a>
            </div>
            <?$i++;endforeach;?>
    </div>
</div>