<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if($arResult['MENU']):?>
    <div class="menu-foot-2">
        <div class="inner">
            <?foreach($arResult['MENU'] as $key => $item):?>
                <ul class="menu_level_1 break-word list-reset">
                    <?if(empty($item['LINK'])):?>
                        <li class="item_1"><span><span><?=$item['TEXT']?></span></span>
                    <?elseif($item['SELECTED'] && $item['LINK'] == $APPLICATION->GetCurDir()):?>
                        <li class="item_1 active"><span><span><?=$item['TEXT']?></span></span>
                    <?else:?>
                        <li class="item_1<?if($item['SELECTED']):?> active<?endif;?>"><a href="<?=$item['LINK']?>"><span><?=$item['TEXT']?></span></a>
                    <?endif;?>
                    <?if($item['ITEMS']):?>
                        <div class="submenu">
                            <ul class="menu_level_2 list-reset">
                                <?foreach($item['ITEMS'] as $item2):?>
                                    <?if(empty($item2['LINK'])):?>
                                        <li class="item_2">
                                            <span><span><?=$item2['TEXT']?></span></span>
                                    <?elseif($item['SELECTED'] && $item2['LINK'] == $APPLICATION->GetCurDir()):?>
                                        <li class="item_2 active">
                                            <span><span><?=$item2['TEXT']?></span></span>
                                    <?else:?>
                                        <li class="item_2<?if($item2['SELECTED']):?> active<?endif;?>">
                                            <a href="<?=$item2['LINK']?>"><span><?=$item2['TEXT']?></span></a>
                                    <?endif;?>
                                    </li>
                                <?endforeach;?>
                            </ul>
                        </div>
                    <?endif;?>
                    </li>
                </ul>
            <?endforeach;?>
        </div>
    </div>
<?endif;?>