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
}
$itemBasket = false;
if(count($arResult['ITEMS'])>0){
    $itemBasket = true;
}
?>

<?if($arParams['AJAX_UPD'] == 'Y'):?>
    <?$GLOBALS['APPLICATION']->RestartBuffer();?>
    <?if(count($arResult['ITEMS'])>0):?>
        <div data-toggle="dropdown" class="dropdown-toggle">
            <?if(count($arResult['ITEMS'])>0):?>
                <span class="icon"><?=count($arResult['ITEMS'])?></span>
            <?endif;?>
        </div>
        <div class="dropdown-menu">
            <div class="container">
                <?if($itemBasket):?>
                    <a href="<?=$arParams['PATH_TO_BASKET']?>">
                        <div class="title"><?=GetMessage('TSBS_SMALLBASKET_TITLE')?></div>
                        <div class="price"><?=$price?></div>
                    </a>
                <?else:?>
                    <div class="title"><?=GetMessage('TSBS_SMALLBASKET_TITLE')?></div>
                <?endif;?>
            </div>
        </div>
    <?endif;?>
    <?die();?>
<?else:?>
    <div class="basket-header-mob-2 dropdown" id="basket_mobile_products">
        <div data-toggle="dropdown" class="dropdown-toggle">
            <?if(count($arResult['ITEMS'])>0):?>
                <span class="icon"><?=count($arResult['ITEMS'])?></span>
            <?endif;?>
        </div>
        <div class="dropdown-menu">
            <div class="container">
                <?if($itemBasket):?>
                    <a href="<?=$arParams['PATH_TO_BASKET']?>">
                        <div class="title"><?=GetMessage('TSBS_SMALLBASKET_TITLE')?></div>
                        <div class="price"><?=$price?></div>
                    </a>
                <?else:?>
                    <div class="title"><?=GetMessage('TSBS_SMALLBASKET_TITLE')?></div>
                <?endif;?>
            </div>
        </div>
    </div>
<?endif;?>

<?//pr($arResult);?>