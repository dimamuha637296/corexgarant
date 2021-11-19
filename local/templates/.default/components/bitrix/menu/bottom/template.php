<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult)):
    $path = str_replace(".php", "/", $APPLICATION->GetCurPage(false));
    $path = explode("/", $path);
    $countPath = count($path);
    ?>
    <ul class="menu_level_1 list-reset">
        <?foreach($arResult as $key => $arItem):
            if ($arItem['PARAMS']['HIDE'] == 'Y'){
                continue;
                }
            if ($arItem["SELECTED"]):?>
                <li class="item_1 active">
                    <?if($arItem['DEPTH_LEVEL'] == 1):
                        if(!empty($path[1]) && strpos($arItem["LINK"], $path[$countPath-2]) === false):?>
                            <a <?if($arItem["PARAMS"]['TARGET_BLANK'] == 'Y'):?>target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                        <?else:?>
                            <span><?=$arItem["TEXT"]?></span>
                        <?endif;
                        else:?>
                        <span><?=$arItem["TEXT"]?></span>
                    <?endif;?>
                </li>
            <?else:?>
                <li class="item_1">
                    <a <?if($arItem["PARAMS"]['TARGET_BLANK'] == 'Y'):?>target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                </li>
            <?endif;
        endforeach;?>
    </ul>
<?endif;?>
