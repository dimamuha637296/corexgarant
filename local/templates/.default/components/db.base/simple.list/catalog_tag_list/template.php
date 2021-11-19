<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);


if(count($arResult["ITEMS"]) < 1): return false; endif;?>
<?if(strlen($arParams["BLOCK_TITLE"])>0):?>
    <div class="h2"><?=$arParams["BLOCK_TITLE"]?></div>
<?endif;?>
<div class="row row-clear catalog-tag-list mb_2">

    <?foreach($arResult["ITEMS"] as $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        if(strlen($arItem["PROPERTIES"]["HREF"]["VALUE"])>0){
            $arItem["DETAIL_PAGE_URL"] = $arItem["PROPERTIES"]["HREF"]["VALUE"];
        }
    ?>
        <div class="col-md-4 col-sm-6 col-12 item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["~NAME"]?></a>
        </div>
    <?endforeach;?>
</div>
