<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult):?>
    <div class="menu-foot">
        <ul class="menu_level_1 break-word list-reset">
            <?foreach($arResult as $item):?>
                <?if(empty($item['LINK'])):?>
                    <li class="item_1"><span><span><?=$item['TEXT']?></span></span>
                <?elseif($item['SELECTED'] && $item['LINK'] == $APPLICATION->GetCurDir()):?>
                    <li class="item_1 active"><span><span><?=$item['TEXT']?></span></span>
                <?else:?>
                    <li class="item_1<?if($item['SELECTED']):?> active<?endif;?>"><a href="<?=$item['LINK']?>"><span><?=$item['TEXT']?></span></a>
                <?endif;?>
                </li>
            <?endforeach;?>
        </ul>
    </div>
<?endif;?>