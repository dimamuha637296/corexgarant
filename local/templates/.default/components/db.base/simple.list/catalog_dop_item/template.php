<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if(count($arResult["ITEMS"]) < 1): return false; endif;?>

<div class="h2"><?=$arParams["TEXT_DOP_ITEMS"]?></div>
<div class="catalog catalog-list similar js-height">
    <div class="row row-clear">
        <?foreach($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $bHasPicture = is_array($arItem['PREVIEW_IMG']);
            ?>
            <div class="item col-sm-4 col-12" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="wrap">
                    <div class="pic js-trg">
                        <a class="link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <?if($bHasPicture):?>
                                <img class="img" src="<?=$arItem['PREVIEW_IMG']['SRC'];?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
                            <?else:?>
                                <img class="img" src="<?=$arParams['DEFAULT_IMG'];?>" alt="no picture"/>
                            <?endif;?>
                        </a>
                    </div>
                    <div class="title">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"];?>">
                            <?=$arItem["~NAME"]?>
                        </a>
                    </div>
                    <?if($arItem['PROPERTIES']['OLD_PRICE']['VALUE']):?>
                        <div class="price-old">
                            <?=number_format($arItem['PROPERTIES']['OLD_PRICE']['VALUE'], 0, '', ' ')?> <?=$arParams["CATALOG_CURRENCY"]?>
                        </div>
                    <?endif;?>
                    <?if($arItem['PROPERTIES']['PRICE']['VALUE']):?>
                        <div class="price">
                            <?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ')?> <?=$arParams["CATALOG_CURRENCY"]?>
                        </div>
                    <?endif;?>
                </div>
            </div>
        <?endforeach;?>
    </div>
</div>
<?//pr($arResult);?>