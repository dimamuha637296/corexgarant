<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
//echo '<pre>'; print_r($arResult); echo '</pre>';
if (count($arResult) < 1)
	return;

$path = str_replace(".php", "/", $APPLICATION->GetCurPage(false));
$path = explode("/", $path);
$countPath = count($path);

$bManyIblock = array_key_exists("IBLOCK_ROOT_ITEM", $arResult[0]["PARAMS"]);
?>

<ul class="break-word list-reset menu_level_1">
<?
$k="1";
	$previousLevel = 0;
	foreach($arResult as $key => $arItem):

		$flgTarget = false;
		if(strpos($arItem["LINK"], '#print') !== false){
			$arItem["LINK"] = '#print';
			$flgTarget = true;
		}

//*
		if($previousTop && $arItem["DEPTH_LEVEL"] == "1" && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?if($previousLevel==2):?>
				</ul></div><?$APPLICATION->IncludeFile(
						SITE_DIR.'include/top_menu_tags.php',
						Array(),
						Array("MODE"=>"text", "SHOW_BORDER" => false, 'TEMPLATE' => 'default.php')
					);?>
				</div></li>
			<?elseif($previousLevel==3):?>
				</ul></div></div></li></ul></div><?$APPLICATION->IncludeFile(
					SITE_DIR.'include/top_menu_tags.php',
					Array(),
					Array("MODE"=>"text", "SHOW_BORDER" => false, 'TEMPLATE' => 'default.php')
				);?>
				</div>
				</li>
			<?endif;?>
		<?elseif($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
			echo str_repeat("</ul></div></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		endif;
//*/
		$bHasSelected = $arItem['SELECTED'];


		if ($arItem["IS_PARENT"]):
			$i = $key;

			$childSelected = false;
			while ($arResult[++$i]['DEPTH_LEVEL'] > $arItem['DEPTH_LEVEL'])
			{
				if ($arResult[$i]['SELECTED'])
				{
					$bHasSelected = $childSelected = true; break;
				}
			}?>
			<?if ($arItem['DEPTH_LEVEL'] == 1) :

				if($arItem['PARAMS']['TOP'] == "Y"){
					$menuTop = true;
				}else{
					$menuTop = false;
				}
				if($bHasSelected):?>
					<?if ($childSelected) :?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> type-<?=($menuTop?"1":"0");?> active">
		                    <a href="<?=$arItem["LINK"]?>" >
								<span class="a-wrap"><?=$arItem["TEXT"]?>
								<?if($menuTop):?>
									<span class="icon-sub_w"><i class="icon-sub"></i></span>
								<?endif;?>
								</span>
								<?if(!$menuTop):?>
									<i class="sp-arr-menu icon"></i>
								<?endif;?>
							</a>
					<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> type-<?=($menuTop?"1":"0");?> active">
	                    	<span><span class="a-wrap"><?=$arItem["TEXT"]?>
	                    		<?if($menuTop):?>
									<span class="icon-sub_w"><i class="icon-sub"></i></span>
								<?endif;?>
	                    		</span>
	                    		<?if(!$menuTop):?>
									<i class="sp-arr-menu icon"></i>
								<?endif;?>
							</span>
					<?endif;?>
				<?else:?>
					<li class="item_<?=$arItem["DEPTH_LEVEL"]?> type-<?=($menuTop?"1":"0");?> ">
	                    <a href="<?=$arItem["LINK"]?>">
							<span class="a-wrap"><?=$arItem["TEXT"]?>
								<?if($menuTop):?>
									<span class="icon-sub_w"><i class="icon-sub"></i></span>
								<?endif;?>
							</span>
							<?if(!$menuTop):?>
							<i class="sp-arr-menu icon"></i>
							<?endif;?>
						</a>
				<?endif;?>
					<div id="menuDrop-6-<?=$k?>-0-0" class="submenu">
						<div class="<?=($menuTop?"js-menu-inner":"");?> menu-inner">
							<ul class="break-word menu_level_<?=($arItem["DEPTH_LEVEL"]+1)?> list-reset <?=($menuTop?"js-menu":"");?>">
			<?else:?>
				<?if($bHasSelected):?>
					<?if ($childSelected) :?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?=($menuTop && $arItem["DEPTH_LEVEL"]=="2" ?" js-item":"")?>">
							<a href="<?=$arItem["LINK"]?>">
								<span><?=$arItem["TEXT"]?></span>
								<?if(!$menuTop):?>
									<i class="sp-arr-menu-5 icon"></i>
								<?endif;?>
							</a>
					<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?=($menuTop && $arItem["DEPTH_LEVEL"]=="2" ?" js-item":"")?>">
							<span>
								<span><?=$arItem["TEXT"]?></span>
								<?if(!$menuTop):?>
									<i class="sp-arr-menu-5 icon"></i>
								<?endif;?>
							</span>
					<?endif;?>
				<?else:?>
					<li class="item_<?=$arItem["DEPTH_LEVEL"]?><?=($menuTop && $arItem["DEPTH_LEVEL"]=="2" ?" js-item":"")?>">
						<a href="<?=$arItem["LINK"]?>">
							<span><?=$arItem["TEXT"]?></span>
							<?if(!$menuTop):?>
								<i class="sp-arr-menu-5 icon"></i>
							<?endif;?>
						</a>
				<?endif;?>
					<?if($arItem["DEPTH_LEVEL"]!="2"):?>
						<span data-href="#" data-toggle="collapse" data-target="#menuDrop-6-<?=$k?>-0-0" class="cur-pointer<?if(!$bHasSelected):?> collapsed<?endif;?>">
							<i class="sp-arr-menu-6 icon"></i>
						</span>
					<?endif;?>
					<div <?if($arItem["DEPTH_LEVEL"]!="2"):?>id="menuDrop-6-<?=$k?>-0-0"<?endif;?> class="submenu <?if($arItem["DEPTH_LEVEL"]!="2"):?>collapse<?if($bHasSelected):?> in<?endif;?><?endif;?>">
						<div class="">
							<ul class="break-word menu_level_<?=($arItem["DEPTH_LEVEL"]+1)?> list-reset">
			<?endif;?>
		<?else:
			if ($arItem["PERMISSION"] > "D"):
					$path_cur = str_replace(".php", "/", $arItem["LINK"]);
					$path_cur = explode("/", $path_cur);
					$countPath_cur = count($path_cur);
				?>
					<?if($bHasSelected):
						if($countPath > $countPath_cur):?>
							<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active<?=($arItem["DEPTH_LEVEL"]=="1"?" type-0":"")?><?=($arItem["DEPTH_LEVEL"]=="2" && $menuTop?" js-item":"")?>">
								<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
							</li>
						<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?=($arItem["DEPTH_LEVEL"]=="1"?" type-0":"")?><?=($arItem["DEPTH_LEVEL"]=="2" && $menuTop?" js-item":"")?>">
							<span><?=$arItem["TEXT"]?></span>
						</li>
						<?endif;?>
					<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?><?=($arItem["DEPTH_LEVEL"]=="1"?" type-0":"")?><?=($arItem["DEPTH_LEVEL"]=="2" && $menuTop?" js-item":"")?>">
							<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
						</li>
					<?endif;?>
				<?/*endif;*/?>
			<?endif;?>
		<?endif;?>
<?
$k=$k+1;
$previousTop = $menuTop;
$previousLevel = $arItem["DEPTH_LEVEL"];

	endforeach;
	if ($previousLevel > 1):
		echo str_repeat("</ul></div></div></li>", ($previousLevel-1) );
	endif;
?>
</ul>

<script>
!function () {
	'use strict';

	var menuDrop6 = {

		timer: {},

		getMenuHeight: function () {
			var minHeight = 9999;
			var menuName;
			for (var key in menuDrop6.menus) {
				if (!menuDrop6.menus.hasOwnProperty(key)) {
					return false;
				}
				var elementHeight = menuDrop6.menus[key].outerHeight();
				if (minHeight > elementHeight) {
					minHeight = elementHeight;
					menuName = key;
				}
			}
			return menuName;
		},

		sortMenu: function () {
			this.body = $('body');
			this.body.addClass('menuDrop6-init');
			this.menus = {};
			this.menus.menu1 = this.menu.find('.js-menu');
			this.menuInner = this.menus.menu1.closest('.js-menu-inner');
			this.columns = Math.round(this.menuInner.outerWidth() / this.menus.menu1.outerWidth());
			this.items.detach();
			this.menuInner.find('.menu_level_2').not('.js-menu').remove();
			for (var i = 2; i <= menuDrop6.columns; i++) {
				this.menus['menu' + i] = $('<ul class="break-word list-reset menu_level_2"></ul>').appendTo(this.menus.menu1.parent());
			}
			this.items.each(function (i, item) {
				menuDrop6.menus[menuDrop6.getMenuHeight()].append(item);
			});
			this.body.removeClass('menuDrop6-init');
		},

		//Width submenu menu-drop
		setWidth: function () {
			if (this.menu.length) {
				this.subMenu = this.menu.find('.type-1').children('.submenu');
				if (this.subMenu.length) {
                    this.subMenu.css({
                        'width': this.menu.outerWidth()
                    });
				}
			}
		},

		init: function () {
			this.window = $(window);

			$(function () {
				menuDrop6.menu = $('.menu-drop-6');
				menuDrop6.setWidth();
				menuDrop6.items = menuDrop6.menu.find('.js-item');
				menuDrop6.sortMenu();
			});
			this.window.on('load', function () {
				menuDrop6.setWidth();
				menuDrop6.sortMenu();
			});
			this.window.on('resize', function () {
				clearTimeout(menuDrop6.timer);
				menuDrop6.timer = setTimeout(function () {
					menuDrop6.setWidth();
					menuDrop6.sortMenu();
				}, 150);
			});
		}
	};
	menuDrop6.init();
}();
</script>


