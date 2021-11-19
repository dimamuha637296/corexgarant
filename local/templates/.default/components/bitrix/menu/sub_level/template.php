<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult):?>
    <ul class="break-word list-reset menu_level_2 js-menu">
        <?foreach($arResult as $key2 => $item2):?>
            <?if(empty($item2['LINK'])):?>
                <li class="item_2 js-item"><span><span><?=$item2['TEXT']?></span></span>
            <?elseif($item2['SELECTED'] && $item2['LINK'] == $APPLICATION->GetCurDir()):?>
                <li class="item_2 js-item active"><span><span><?=$item2['TEXT']?></span></span>
            <?else:?>
                <li class="item_2 js-item<?if($item2['SELECTED']):?> active<?endif;?>"><a href="<?=$item2['LINK']?>"><span><?=$item2['TEXT']?></span></a>
            <?endif;?>
                <?if($arParams['ITEMS'])://полная структура каталога?>
                    <?foreach($arParams['ITEMS'] as $subItem):?>
                        <?if($subItem['LINK'] == $item2['LINK'] && !empty($subItem['ITEMS'])):?>
                            <div class="submenu-inner">
                                <ul class="break-word list-reset menu_level_3">
                                    <?foreach($subItem['ITEMS'] as $key3 => $item3):?>
                                        <?if(empty($item3['LINK'])):?>
                                            <li class="item_3"><span><span><?=$item3['TEXT']?></span></span><?if($item3['ITEMS']):?><span class="icon<?if(!$item3['SELECTED']):?> collapsed<?endif;?>" data-href="#" data-toggle="collapse" data-target="#submenu-big-<?=$key2.$key3?>"></span><?endif;?>
                                        <?elseif($item3['SELECTED'] && $item3['LINK'] == $APPLICATION->GetCurDir()):?>
                                            <li class="item_3 active"><span><span><?=$item3['TEXT']?></span></span><?if($item3['ITEMS']):?><span class="icon<?if(!$item3['SELECTED']):?> collapsed<?endif;?>" data-href="#" data-toggle="collapse" data-target="#submenu-big-<?=$key2.$key3?>"></span><?endif;?>
                                        <?else:?>
                                            <li class="item_3<?if($item3['SELECTED']):?> active<?endif;?>"><a href="<?=$item3['LINK']?>"><span><?=$item3['TEXT']?></span></a><?if($item3['ITEMS']):?><span class="icon<?if(!$item3['SELECTED']):?> collapsed<?endif;?>" data-href="#" data-toggle="collapse" data-target="#submenu-big-<?=$key2.$key3?>"></span><?endif;?>
                                        <?endif;?>
                                        <?if($item3['ITEMS']):?>
                                            <div class="submenu-inner collapse<?if($item3['SELECTED']):?> show<?endif;?>" id="submenu-big-<?=$key2.$key3?>">
                                                <ul class="break-word list-reset menu_level_4">
                                                    <?foreach($item3['ITEMS'] as $key4 => $item4):?>
                                                        <?if(empty($item4['LINK'])):?>
                                                            <li class="item_4"><span><span><?=$item4['TEXT']?></span></span><?if($item4['ITEMS']):?><span class="icon<?if(!$item4['SELECTED']):?> collapsed<?endif;?>" data-href="#" data-toggle="collapse" data-target="#submenu-big-<?=$key2.$key3.$key4?>"></span><?endif;?>
                                                        <?elseif($item4['SELECTED'] && $item4['LINK'] == $APPLICATION->GetCurDir()):?>
                                                            <li class="item_4 active"><span><span><?=$item4['TEXT']?></span></span><?if($item4['ITEMS']):?><span class="icon<?if(!$item4['SELECTED']):?> collapsed<?endif;?>" data-href="#" data-toggle="collapse" data-target="#submenu-big-<?=$key2.$key3.$key4?>"></span><?endif;?>
                                                        <?else:?>
                                                            <li class="item_4<?if($item4['SELECTED']):?> active<?endif;?>"><a href="<?=$item4['LINK']?>"><span><?=$item4['TEXT']?></span></a><?if($item4['ITEMS']):?><span class="icon<?if(!$item4['SELECTED']):?> collapsed<?endif;?>" data-href="#" data-toggle="collapse" data-target="#submenu-big-<?=$key2.$key3.$key4?>"></span><?endif;?>
                                                        <?endif;?>
                                                    <?endforeach;?>
                                                </ul>
                                            </div>
                                        <?endif;?>
                                        </li>
                                    <?endforeach;?>
                                </ul>
                            </div>
                            <?break?>
                        <?endif;?>
                    <?endforeach;?>
                <?endif;?>
            </li>
        <?endforeach;?>
    </ul>
<?endif;?>
