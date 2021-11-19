<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if($arResult['MENU']):?>
    <?foreach($arResult['MENU'] as $key => $item):?>
        <?if(empty($item['LINK'])):?>
            <li class="item_1<?if($item['ITEMS']):?> has-submenu-2<?endif;?>">
                <span>
                    <span><?=$item['TEXT']?></span><?if($item['ITEMS']):?><span class="icon"></span><?endif;?>
                </span>
        <?elseif($item['SELECTED'] && $item['LINK'] == $APPLICATION->GetCurDir()):?>
            <li class="item_1 active<?if($item['ITEMS']):?> has-submenu-2<?endif;?>">
                <span>
                    <span><?=$item['TEXT']?></span><?if($item['ITEMS']):?><span class="icon"></span><?endif;?>
                </span>
        <?else:?>
            <li class="item_1<?if($item['SELECTED']):?> active<?endif;?><?if($item['ITEMS']):?> has-submenu-2<?endif;?>">
                <a href="<?=$item['LINK']?>">
                    <span><?=$item['TEXT']?></span><?if($item['ITEMS']):?><span class="icon"></span><?endif;?>
                </a>
        <?endif;?>
        <?if($item['ITEMS']):?>
            <div class="submenu-2">
                <div class="submenu-big-2">
                    <div class="inner">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "sub_level",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "86400",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "catalog_column_1",
                                "USE_EXT" => "N",
                                "ITEMS" => $item['ITEMS']
                            ),
                            false
                        );?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "sub_level",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "86400",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "catalog_column_2",
                                "USE_EXT" => "N",
                                "ITEMS" => $item['ITEMS']
                            ),
                            false
                        );?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "sub_level",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "86400",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "catalog_column_3",
                                "USE_EXT" => "N",
                                "ITEMS" => $item['ITEMS']
                            ),
                            false
                        );?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "sub_level",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "86400",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "catalog_column_4",
                                "USE_EXT" => "N",
                                "ITEMS" => $item['ITEMS']
                            ),
                            false
                        );?>
                    </div>
                </div>
            </div>
        <?endif;?>
        </li>
    <?endforeach;?>
<?endif;?>