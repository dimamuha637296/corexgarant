<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?// pr($_SESSION['CATALOG_COMPARE_LIST']);

if(count($arResult)>0){
    $num = count($arResult);
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

?>

<?if($arParams['AJAX_UPD'] == 'Y'):?>
    <?$GLOBALS['APPLICATION']->RestartBuffer();?>
    <?if(count($arResult)>0)
    {?>
       <i class="ico"></i> <span><?=GetMessage("CATALOG_COMPARE")?></span>
            <span class="numb">(<?=count($arResult)?>)</span>
    <?}
    die();?>
<?else:?>

    <div class="compare<?=$arParams["COMPONENT_MOBILE"]=="Y"?"-mob":""?>">
        <ul class="list list-reset">
            <li class="item  compair-prod">
                <a href="<?=$arParams['COMPARE_URL']?>" class="link " rel="nofollow"><i class="ico"></i> <span><?=GetMessage("CATALOG_COMPARE")?></span>
                    <?if(count($arResult)>0):?>
                    <span class="numb">(<?=count($arResult)?>)</span>
                    <?endif;?>
                </a>
            </li>
        </ul>
    </div>
    <? if (!empty($arParams["AREA_CLASS"])) : ?>
        <?
        $arParams['TEMPLATE_FOLDER'] = $templateFolder;
        $arParams['KEYS'] = array_keys($arResult);
        ?>
        <script>
            $(document).ready(function () {
                compareScriptInit(<?=json_encode($arParams)?>);
            });
        </script>
    <?endif;?>
<?endif;?>

