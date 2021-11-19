<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if(count($arResult["ITEMS"]) < 1): return false; endif;?>
<div class="news-main-3">
    <div class="b-title"><?=($arParams["BLOCK_TITLE"]?$arParams["BLOCK_TITLE"]:$arResult["NAME"])?></div>
    <ul class="list list-reset">
        <?foreach($arResult["ITEMS"] as $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                <div class="time">
                    <time datetime="<?=date('Y-m-d', strtotime($arItem["ACTIVE_FROM"]));?>">
                        <?=ToLower($arItem["DISPLAY_ACTIVE_FROM"]);?>
                    </time>
                </div>
            <?endif;?>
            <div class="title"><a href="<?=$arItem["DETAIL_PAGE_URL"];?>"><?=$arItem["~NAME"];?></a></div>
        </li>
        <?endforeach;?>
    </ul>
    <div class="all-news">
        <a href="<?=str_replace("#SITE_DIR#", SITE_DIR, $arResult["LIST_PAGE_URL"]);?>"><?=$arParams["TITLE_ALL_NEWS"]?$arParams["TITLE_ALL_NEWS"]:GetMessage("DB_NEWS_SUBTITLE")?></a>
    </div>
</div>