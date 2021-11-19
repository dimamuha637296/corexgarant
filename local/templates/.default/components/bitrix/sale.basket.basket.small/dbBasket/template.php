<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(count($arResult['ITEMS'])>0){
    $num = count($arResult['ITEMS']);
    $cnt = strlen($num);
    if($cnt>1){
        $num = $num[$cnt-1]+($num[$cnt-2]*10);
    }else{
        $num = '0'.$num;
    }
    if ($num[1] == 1 && $num[0] != 1) {
        $case=1;
    } elseif (2 <= $num[1] && $num[1] <= 4 && $num[0] != 1) {
        $case=2;
    } else {
        $case=3;
    }
}

foreach($arResult['ITEMS'] as $arItem){
    $sum += $arItem['PRICE']*intval($arItem['QUANTITY']?$arItem['QUANTITY']:"1");
    $price = CCurrencyLang::CurrencyFormat($sum, $arParams['CURRENCY']);
	$arParams['BASKET_ITEMS_ID'][] = $arItem["PRODUCT_ID"];
}
$itemBasket = false;
if(count($arResult['ITEMS'])>0){
    $itemBasket = true;
}
?>
<?if($arParams['AJAX_UPD'] == 'Y'):?>
    <?$GLOBALS['APPLICATION']->RestartBuffer();?>
    <?if(count($arResult['ITEMS'])>0):?>
    <a href="<?=$arParams['PATH_TO_BASKET']?>" class="link">
        <i class="ico"></i><span><?=GetMessage("TSBS_SMALLBASKET_TITLE")?></span>
    </a>
    <div class="text">
        <?if(count($arResult['ITEMS'])):?>
            <?=sklonen(count($arResult['ITEMS']), GetMessage("TSBS_SMALLBASKET_TOVAR1"), GetMessage("TSBS_SMALLBASKET_TOVAR2"), GetMessage("TSBS_SMALLBASKET_TOVAR3"))?> <?=GetMessage("TSBS_SMALLBASKET_NA")?> <?=$price?>
        <?else:?>
            <?=GetMessage("TSBS_SMALLBASKET_PUSTO")?>
        <?endif;?>
    </div>
    <?endif;?>
    <?die();?>
<?else:?>
    <div class="basket-header<?=(!$itemBasket?" empty-basket":"");?>">
        <div class="wrap"  id="basket_small_products">
            <?if($itemBasket):?>
                <a href="<?=$arParams['PATH_TO_BASKET']?>" class="link">
            <?else:?>
                <span class="link">
            <?endif;?><i class="ico"></i><span><?=GetMessage("TSBS_SMALLBASKET_TITLE")?></span>
            <?if($itemBasket):?>
                </a>
            <?else:?>
                </span>
            <?endif;?>
            <div class="text">
                <?if(count($arResult['ITEMS'])):?>
                    <?=sklonen(count($arResult['ITEMS']), GetMessage("TSBS_SMALLBASKET_TOVAR1"), GetMessage("TSBS_SMALLBASKET_TOVAR2"), GetMessage("TSBS_SMALLBASKET_TOVAR3"))?> <?=GetMessage("TSBS_SMALLBASKET_NA")?> <?=$price?>
                <?else:?>
                    <?=GetMessage("TSBS_SMALLBASKET_PUSTO")?>
                <?endif;?>
            </div>
        </div>
    </div>

    <? if (!empty($arParams["AREA_CLASS"])) : ?>
        <?
        $arParams['TEMPLATE_FOLDER'] = $templateFolder;
        if($_SESSION["USER_BASKET_CHECKED"] || !empty($_SESSION["USER_BASKET_ITEMS"])){
            $arParams['BASKET_RDY'] = 1;
        }
        ?>
        <script>
            $(document).ready(function () {
                buyScriptInit(<?=json_encode($arParams)?>);
            });
        </script>
    <?endif;?>
<?endif;?>
<?//pr($arResult);?>