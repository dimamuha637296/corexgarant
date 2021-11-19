<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult['ITEMS']):?>
    <div class="sl-main">
        <div class="wrap cursor inited-not">
            <div class="slider">
                <?foreach($arResult["ITEMS"] as $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                    <div class="slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="inner">
                            <div class="pic"><img class="img" src="<?=$arItem['PREVIEW_IMG']['SRC'];?>" alt="<?=$arItem["NAME"]?>"></div>
                            <div class="container">
                                <div class="b-wrap">
                                    <div class="h1 title"><?=$arItem["NAME"]?></div>
                                    <?if($arItem['~DETAIL_TEXT']):?>
                                        <p class="text"><?=$arItem['~DETAIL_TEXT']?></p>
                                    <?endif;?>
                                    <?if($arItem['PROPERTIES']['HREF']['VALUE']):?>
                                        <div class="btn-wrap">
                                            <a class="btn btn-primary"<?if($arItem['PROPERTIES']['NEW_PAGE']['VALUE']):?> target="_blank"<?endif;?> href="<?=$arItem['PROPERTIES']['HREF']['VALUE']?>"><?=$arParams['BTN_TITLE']?></a>
                                        </div>
                                    <?endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
            <div class="js-sl-pager sl-pager"></div>
        </div>
        <div class="sl-nav"><a class="prev" href="#"></a><a class="next" href="#"></a></div>
    </div>
<?endif;?>