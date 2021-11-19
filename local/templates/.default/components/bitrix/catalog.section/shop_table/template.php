<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
<div class="catalog-table ">
    <?$i=1;foreach($arResult["ITEMS"] as $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="item catalog-item item-box" data-id="<?=$arItem['ID']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="wrap">
<?/*
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
*/?>
                <div class="pic js-trg">
                    <a class="link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                        <?if($arItem["PREVIEW_IMG"]):?>
                            <img class="img main-image" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>" alt="<?=$arItem["PREVIEW_IMG"]["ALT"]?>" title="<?=$arItem["PREVIEW_IMG"]["ALT"]?>"/>
                        <?else:?>
                            <img class="img main-image" src="<?=$arParams["DEFAULT_IMG"]?>" alt="no picture">
                        <?endif;?>
                    </a>
                </div>
                <div class="descr-wrap">
                    <div class="title">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <?=$arItem["~NAME"]?>
                        </a>
                    </div>
                    <?if($arItem["~PREVIEW_TEXT"]):?>
                        <div class="text">
                            <?=$arItem["~PREVIEW_TEXT"]?>
                        </div>
                    <?endif;?>
                </div>
                <?if($arItem["MIN_PRICE"]["VALUE"]):?>
                    <div class="price-wrap">
                        <div class="price">
                            <?if($arItem["MIN_PRICE"]["DISCOUNT_DIFF"] > 0):?>
                                <?=$arItem["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"];?>
                            <?else:?>
                                <?=$arItem["MIN_PRICE"]["PRINT_VALUE"];?>
                            <?endif;?>
                        </div>
                        <?if($arItem["MIN_PRICE"]["DISCOUNT_DIFF"] > 0):?>
                            <div class="price-old">
                                <?=$arItem["MIN_PRICE"]["PRINT_VALUE"];?>
                            </div>
                        <?elseif($arItem["PROPERTIES"]["OLD_PRICE"]["VALUE"]):?>
                            <div class="price-old">
                                <?=SaleFormatCurrency($arItem["PROPERTIES"]["OLD_PRICE"]["VALUE"], $arItem["MIN_PRICE"]["CURRENCY"]);?>
                            </div>
                        <?endif;?>
                    </div>
                <?endif;?>
                <?
                $canBuyStatus = canBuyStatus(
                    $arItem["MIN_PRICE"]["VALUE"],
                    $arParams['USE_QUANTITY_FOR_ORDER'],
                    $arItem['CATALOG_QUANTITY'],
                    $arItem['PROPERTIES']['FLG_AVAILABLE']['VALUE_XML_ID']
                );
                ?> 
                <div class="buy">
                    <?if($canBuyStatus == 1):?>
                        <?if($arParams['USE_PRODUCT_QUANTITY'] == "Y"):
                            $itemMeasure = $arItem['CATALOG_MEASURE_RATIO'];
                            ?>
                            <div class="item_buttons_counter_block catalog-btn-counter">
                                <div class="btn-pm">
                                    <a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb btn-down jq-number__spin minus" data-count-delta="<?=$itemMeasure?>"></a>
                                    <input type="text" data-min="<?=$itemMeasure?>" value="<?=$itemMeasure?>" class="tac transparent_input quantity form-control">
                                    <a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb btn-up jq-number__spin plus" data-count-delta="<?=$itemMeasure?>"></a>
                                </div>
                            </div>
                        <?endif;?>
                        <a href="javascript:void(0)" class="btn btn-default btn-xs  btn-buy"><?=$arParams['BTN_MESS_BUY']?></a>
                        <?if($arParams['BUY_ONE_CLICK_SECTION'] == 'Y'): ?>
                            <div class="btn-b">
                                <a href="javascript:void(0)" class="lnk-pseudo buy-one-click" data-id="<?=$arItem["ID"]?>" data-type="catalog" data-toggle="modal" data-target="#buyOneClickForm">
                                    <?=GetMessage("DB_BUY_ONE_CLICK")?>
                                </a>
                            </div>
                        <?endif;?>
                    <?elseif($canBuyStatus == 2):?>
                        <a data-val-item="<?=$arItem["NAME"]?>" data-toggle="modal" data-target="#FRM_preorder" class="btn btn-default css_submit_preorder" >
                            <?=$arParams["BTN_PREORDER"]?>
                        </a>
                    <?elseif($canBuyStatus == 0):?>
                        <p><?=$arParams["BTN_NO_AVAILABLE"]?></p>
                    <?endif;?>
                    <?if($arParams['~DISPLAY_COMPARE'] == 'Y'):?>
                        <label class="label_compare">
                            <input class="formstyler db_compare" type="checkbox">
                            <span><?=($arParams['NAME_COMPARE_BTN']?$arParams['NAME_COMPARE_BTN']:GetMessage("NAME_COMPARE_BTN"))?></span>
                        </label>
                    <?endif;?>
                </div>
            </div>
        </div>
        <?$i++;endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
