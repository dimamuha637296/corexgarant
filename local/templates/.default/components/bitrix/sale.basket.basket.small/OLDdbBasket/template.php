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
    $sum += $arItem['PRICE'];
    $price = CCurrencyLang::CurrencyFormat($sum, $arParams['CURRENCY']);
	$arParams['BASKET_ITEMS_ID'][] = $arItem["PRODUCT_ID"];
}
?>
<?if($arParams['AJAX_UPD'] == 'Y'):?>
    <?$GLOBALS['APPLICATION']->RestartBuffer();?>
    <?if(count($arResult['ITEMS'])>0)
    {
    ?><?=count($arResult['ITEMS'])?> <?=GetMessage('TSBS_SMALLBASKET_TOVAR'.$case)?><?=GetMessage('TSBS_SMALLBASKET_NA')?><?=$price?><?
    } ?>
    <?die();?>
<?else:?>
    <div class="basket-header">
        <a href="<?=$arParams['PATH_TO_BASKET']?>">
            <div class="icon"></div>
            <span class="ttl"><?=GetMessage('TSBS_SMALLBASKET_TITLE')?></span>
            <span id="basket_small_products" class="price">
            <?
            if(count($arResult['ITEMS'])>0)
            {
                ?><?=count($arResult['ITEMS'])?> <?=GetMessage('TSBS_SMALLBASKET_TOVAR'.$case)?><?=GetMessage('TSBS_SMALLBASKET_NA')?><?=$price?><?
            }
            ?>
            </span>
        </a>
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