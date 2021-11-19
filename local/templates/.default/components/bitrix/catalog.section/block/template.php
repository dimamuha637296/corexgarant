<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

?>
<?if($arResult['ITEMS']):?>
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
    <div class="catalog-block js-height">
        <div class="row row-clear">
            <?$i=1;foreach($arResult["ITEMS"] as $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                /*if($arResult["URL"][$arItem["ID"]] && $arResult["URL"][$arItem["ID"]] != $arItem["DETAIL_PAGE_URL"]){
                    $arItem["DETAIL_PAGE_URL"] = $arResult["URL"][$arItem["ID"]];
                }
                */
                ?>
                <div class="item col-sm-3 col-sm-4 col-12" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="wrap">
                        <div class="element-sale">
                            <?if($arItem["PROPERTIES"]["FLG_SALE"]["VALUE_XML_ID"] == "Y"):?>
                                <div class="icon percent"></div>
                            <?endif;?>
                            <?if($arItem["PROPERTIES"]["FLG_NEW"]["VALUE_XML_ID"] == "Y"):?>
                                <div class="icon new"></div>
                            <?endif;?>
                            <?if($arItem["PROPERTIES"]["FLG_HIT"]["VALUE_XML_ID"] == "Y"):?>
                                <div class="icon sale"></div>
                            <?endif;?>
                        </div>
                        <div class="pic js-trg">
                            <a class="link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                <?if($arItem["PREVIEW_IMG"]):?>
                                    <img class="img" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>" alt="<?=$arItem["PREVIEW_IMG"]["ALT"]?>" title="<?=$arItem["PREVIEW_IMG"]["ALT"]?>"/>
                                <?else:?>
                                    <img class="img" src="<?=$arParams["DEFAULT_IMG"]?>" alt="no picture">
                                <?endif;?>
                            </a>
                        </div>
                        <div class="title">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                <?=$arItem["~NAME"]?>
                            </a>
                        </div>

                        <div class="price-wrap">
                            <?if($arItem["PROPERTIES"]["OLD_PRICE"]["VALUE"]):?>
                                <div class="price-old">
                                    <?=number_format($arItem["PROPERTIES"]["OLD_PRICE"]["VALUE"], 0, '', '.')?> <?=$arParams["CATALOG_CURRENCY"]?>
                                </div>
                            <?endif;?>
                            <?if($arItem["PROPERTIES"]["PRICE"]["VALUE"]):?>
                                <div class="price">
                                    <?=number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, '', ' ')?> <?=$arParams["CATALOG_CURRENCY"]?>
                                </div>
                            <?endif;?>
                        </div>
                        <div class="buy">
                        <button class="btn btn-default css_submit_catalog" type="button" data-toggle="modal" data-target="#FRM_catalog" data-name="<?=$arItem["NAME"]?>">
                            <?=(strlen($arParams["BTN_NAME"])>0 ? $arParams["BTN_NAME"] : GetMessage("DB_DEFAULT_NAME_BTN"))?>
                        </button>
                        </div>

                    </div>
                </div>
                <?$i++;endforeach;?>
        </div>
    </div>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
<?else:?>
    <p><?=GetMessage('DB_NO_ITEMS')?>.</p>
<?endif;?>