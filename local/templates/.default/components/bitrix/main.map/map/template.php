<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if (!is_array($arResult["arMap"]) || count($arResult["arMap"]) < 1)
    return;

$arRootNode = Array();
foreach($arResult["arMap"] as $index => $arItem)
{
    if ($arItem["LEVEL"] == 0)
        $arRootNode[] = $index;
}
if($arParams["SHOW_NUMBER"] != "Y"){
    $showNumber = "no-counter";
}

$arParams['COL_NUM'] = isset($arParams['COL_NUM']) ? intval($arParams['COL_NUM']) : 2;
$arParams['COL_MAX'] = isset($arParams['COL_MAX']) ? intval($arParams['COL_MAX']) : COption::GetOptionString("db.base","COLUM_MAX", "12");
$allNum = count($arRootNode);
$colNum = ceil($allNum / $arParams["COL_NUM"]);


$arParams['COLUM_GRID'] = (
    $arParams['COL_MAX'] % $arParams['COL_NUM']) > 0
    ? intval( $arParams['COL_MAX']  / $arParams['COL_NUM'] ) - 1
    : intval( $arParams['COL_MAX']  / $arParams['COL_NUM']
    );
?>

<div class="sitemap">
    <ul class="sitemap-menu menu_level_1 list-reset clearfix">

    <?
        $previousLevel = -1;
        $counter = 0;
        $column = 1;
        foreach($arResult["arMap"] as $index => $arItem):?>

        <?if ($arItem["LEVEL"] < $previousLevel):?>
            <?=str_repeat("</ol></li>", ($previousLevel - $arItem["LEVEL"]));?>
        <?endif?>


        <?if ($counter >= $colNum && $arItem["LEVEL"] == 0):
        $allNum = $allNum-$counter;
        $colNum = ceil(($allNum) / ($arParams["COL_NUM"] > 1 ? ($arParams["COL_NUM"]-$column) : 1));
        $counter = 0;
        $column++;
        ?>
    </ol></div><div class=" <?=($arParams["COL_NUM"] >= $column ? 'sitemap' : '' )?>"><ol class="menu_level_<?=$arItem["FULL_PATH"]+1?> list-reset">
        <?endif?>

        <?if (array_key_exists($index+1, $arResult["arMap"]) && $arItem["LEVEL"] < $arResult["arMap"][$index+1]["LEVEL"]):?>

        <li class="item_<?=$arItem["LEVEL"]+1?> <?=$showNumber?>">
            <a href="<?=$arItem["FULL_PATH"]?>"><?=$arItem["NAME"]?></a>
            <?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0) {?>

            <div class="desc"><?=$arItem["DESCRIPTION"]?></div><?}?>
            <ol class="menu_level_<?=$arItem["LEVEL"]+2?> list-reset" >


                <?else:
                    if(substr($arItem["FULL_PATH"], 0, 2) !== '/#'):
                ?>
                <?if(count($arItem["CHILDREN"])>0){
                    $depth = 2;
                }else{
                   $depth = 1;
                }
                ?>
                <li class="item_<?=$arItem["LEVEL"]+$depth?>"><a href="<?=$arItem["FULL_PATH"]?>"><?=$arItem["NAME"]?></a><?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0) {?><div class="desc"><?=$arItem["DESCRIPTION"]?></div><?}?></li>

                    <?
                    endif;
                endif?>


                <?
                $previousLevel = $arItem["LEVEL"];
                if($arItem["LEVEL"] == 0)
                    $counter++;
                ?>

                <?endforeach?>

                <?if ($previousLevel > 1)://close last item tags?>
                    <?=str_repeat("</ol></li>", ($previousLevel-1) );?>
                <?endif?>

            </ul>
</div>

<?/*/?><pre><?print_r($arResult)?></pre><?//*/?>