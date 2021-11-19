<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if($arResult['MENU']):?>
    <?foreach($arResult['MENU'] as $key => $item):?>
        <?if(empty($item['LINK'])):?>
            <li class="item_1<?if($item['ITEMS']):?> has-submenu<?endif;?>">
                <span>
                    <span><?=$item['TEXT']?></span><?if($item['ITEMS']):?><i class="icon"></i><?endif;?>
                </span>
        <?elseif($item['SELECTED'] && $item['LINK'] == $APPLICATION->GetCurDir()):?>
            <li class="item_1 active<?if($item['ITEMS']):?> has-submenu<?endif;?>">
                <span>
                    <span><?=$item['TEXT']?></span><?if($item['ITEMS']):?><i class="icon"></i><?endif;?>
                </span>
        <?else:?>
            <li class="item_1<?if($item['SELECTED']):?> active<?endif;?><?if($item['ITEMS']):?> has-submenu<?endif;?>">
                <a href="<?=$item['LINK']?>">
                    <span><?=$item['TEXT']?></span><?if($item['ITEMS']):?><i class="icon"></i><?endif;?>
                </a>
        <?endif;?>
        <?if($item['ITEMS']):?>
            <div class="submenu">
                <div class="submenu-3">
                    <ul class="menu_level_2 list-reset">
                        <?foreach($item['ITEMS'] as $item2):?>
                            <?if(empty($item2['LINK'])):?>
                                <li class="item_2"><span><span><?=$item2['TEXT']?></span><?if($item2['ITEMS']):?><span class="icon"></span><?endif;?></span>
                            <?elseif($item2['SELECTED'] && $item2['LINK'] == $APPLICATION->GetCurDir()):?>
                                <li class="item_2 active"><span><span><?=$item2['TEXT']?><?if($item2['ITEMS']):?><span class="icon"></span><?endif;?></span></span>
                            <?else:?>
                                <li class="item_2<?if($item2['SELECTED']):?> active<?endif;?>"><a href="<?=$item2['LINK']?>"><span><?=$item2['TEXT']?><?if($item2['ITEMS']):?><span class="icon"></span><?endif;?></span></a>
                            <?endif;?>
                            <?if($item2['ITEMS']):?>
                                <div class="submenu-inner">
                                    <ul class="menu_level_3 list-reset">
                                        <?foreach($item2['ITEMS'] as $item3):?>
                                            <?if(empty($item3['LINK'])):?>
                                                <li class="item_3"><span><span><?=$item3['TEXT']?><?if($item3['ITEMS']):?><span class="icon"></span><?endif;?></span></span>
                                            <?elseif($item3['SELECTED'] && $item3['LINK'] == $APPLICATION->GetCurDir()):?>
                                                <li class="item_3 active"><span><span><?=$item3['TEXT']?><?if($item3['ITEMS']):?><span class="icon"></span><?endif;?></span></span>
                                            <?else:?>
                                                <li class="item_3<?if($item3['SELECTED']):?> active<?endif;?>"><a href="<?=$item3['LINK']?>"><span><?=$item3['TEXT']?><?if($item3['ITEMS']):?><span class="icon"></span><?endif;?></span></a>
                                            <?endif;?>
                                            <?if($item3['ITEMS']):?>
                                                <div class="submenu-inner">
                                                    <ul class="menu_level_4 list-reset">
                                                        <?foreach($item3['ITEMS'] as $item4):?>
                                                            <?if(empty($item4['LINK'])):?>
                                                                <li class="item_4"><span><span><?=$item4['TEXT']?></span></span>
                                                            <?elseif($item4['SELECTED'] && $item4['LINK'] == $APPLICATION->GetCurDir()):?>
                                                                <li class="item_4 active"><span><span><?=$item4['TEXT']?></span></span>
                                                            <?else:?>
                                                                <li class="item_4<?if($item4['SELECTED']):?> active<?endif;?>"><a href="<?=$item4['LINK']?>"><span><?=$item4['TEXT']?></span></a>
                                                            <?endif;?>
                                                        <?endforeach;?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?endif;?>
                                            </li>
                                        <?endforeach;?>
                                    </ul>
                                </div>
                            <?endif;?>
                            </li>
                        <?endforeach;?>
                    </ul>
                </div>
            </div>
        <?endif;?>
        </li>
    <?endforeach;?>
        <li class="item_1 more has-submenu"><span><span><?=GetMessage('DB_MENU_ALL')?></span><span class="icon"></span></span>
            <div class="submenu">
                <div class="submenu-3">
                    <ul class="menu_level_2 list-reset"></ul>
                </div>
            </div>
        </li>
<?endif;?>