<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if($arResult['MENU']):?>
    <nav class="menu-aside-3">
        <ul class="menu_level_1 list-reset break-word">
            <?foreach($arResult['MENU'] as $key => $item):?>
                <?if(empty($item['LINK'])):?>
                    <li class="item_1"><span><span><?=$item['TEXT']?></span></span><?if($item['ITEMS']):?><a class="icon" data-toggle="collapse" href="#accordion-m-<?=$key?>"></a><?endif;?>
                <?elseif($item['SELECTED'] && $item['LINK'] == $APPLICATION->GetCurDir()):?>
                    <li class="item_1 active"><span><span><?=$item['TEXT']?></span></span><?if($item['ITEMS']):?><a class="icon" data-toggle="collapse" href="#accordion-m-<?=$key?>"></a><?endif;?>
                <?else:?>
                    <li class="item_1<?if($item['SELECTED']):?> active<?endif;?>"><a href="<?=$item['LINK']?>"><span><?=$item['TEXT']?></span></a><?if($item['ITEMS']):?><a class="icon<?if(!$item['SELECTED']):?> collapsed<?endif;?>" data-toggle="collapse" href="#accordion-m-<?=$key?>"></a><?endif;?>
                <?endif;?>
                <?if($item['ITEMS']):?>
                    <div class="collapse<?if($item['SELECTED']):?> show<?endif;?>" id="accordion-m-<?=$key?>">
                        <ul class="menu_level_2 list-reset">
                            <?foreach($item['ITEMS'] as $key2 => $item2):?>
                                <?if(empty($item2['LINK'])):?>
                                    <li class="item_2"><span><span><?=$item2['TEXT']?></span></span><?if($item2['ITEMS']):?><a class="icon" data-toggle="collapse" href="#accordion-m-<?=$key?><?=$key2?>"></a><?endif;?>
                                <?elseif($item2['SELECTED'] && $item2['LINK'] == $APPLICATION->GetCurDir()):?>
                                    <li class="item_2 active"><span><span><?=$item2['TEXT']?></span></span><?if($item2['ITEMS']):?><a class="icon" data-toggle="collapse" href="#accordion-m-<?=$key?><?=$key2?>"></a><?endif;?>
                                <?else:?>
                                    <li class="item_2<?if($item2['SELECTED']):?> active<?endif;?>"><a href="<?=$item2['LINK']?>"><span><?=$item2['TEXT']?></span></a><?if($item2['ITEMS']):?><a class="icon<?if(!$item2['SELECTED']):?> collapsed<?endif;?>" data-toggle="collapse" href="#accordion-m-<?=$key?><?=$key2?>"></a><?endif;?>
                                <?endif;?>
                                <?if($item2['ITEMS']):?>
                                    <div class="collapse<?if($item2['SELECTED']):?> show<?endif;?>" id="accordion-m-<?=$key?><?=$key2?>">
                                        <ul class="menu_level_3 list-reset">
                                            <?foreach($item2['ITEMS'] as $item3):?>
                                                <?if(empty($item3['LINK'])):?>
                                                    <li class="item_3"><span><?=$item3['TEXT']?></span></li>
                                                <?elseif($item3['SELECTED'] && $item3['LINK'] == $APPLICATION->GetCurDir()):?>
                                                    <li class="item_3 active"><span><?=$item3['TEXT']?></span></li>
                                                <?else:?>
                                                    <li class="item_3<?if($item3['SELECTED']):?> active<?endif;?>"><a href="<?=$item3['LINK']?>"><?=$item3['TEXT']?></a></li>
                                                <?endif;?>
                                            <?endforeach;?>
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
    </nav>
<?endif;?>