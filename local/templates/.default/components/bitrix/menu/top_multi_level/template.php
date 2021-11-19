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

<ul class="menu_level_1 break-word list-reset">
<?
	$previousLevel = 0;
	foreach($arResult as $key => $arItem):

		$flgTarget = false;
		if(strpos($arItem["LINK"], '#print') !== false){
			$arItem["LINK"] = '#print';
			$flgTarget = true;
		}
		if($previousTop && $arItem["DEPTH_LEVEL"] == "1" && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?if($previousLevel==2):?>
				</ul><?$APPLICATION->IncludeFile(
		SITE_DIR.'include/top_menu_tags.php',
		Array(),
		Array("MODE"=>"text", "SHOW_BORDER" => false, 'TEMPLATE' => 'default.php')
	);?></div></li>
			<?elseif($previousLevel==3):?>
				</ul></div></li></ul><?$APPLICATION->IncludeFile(
		SITE_DIR.'include/top_menu_tags.php',
		Array(),
		Array("MODE"=>"text", "SHOW_BORDER" => false, 'TEMPLATE' => 'default.php')
	);?></div></li>
		<?endif;?>


		<?elseif ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
			echo str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		endif;
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
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> submenu-<?=($menuTop?"2":"1");?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
		                    <a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>" >
								<span class="a-wrap"><?=$arItem["TEXT"]?></span>
								<i class="png-arr-menu icon"></i>
							</a>
							<div class="submenu">
								<ul class="menu_level_<?=($arItem["DEPTH_LEVEL"]+1)?> list-reset ">
					<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> submenu-<?=($menuTop?"2":"1");?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
	                    	<span><span class="a-wrap"><?=$arItem["TEXT"]?></span>
								<i class="png-arr-menu icon"></i>
							</span>
								<div class="submenu">
								<ul class="menu_level_<?=($arItem["DEPTH_LEVEL"]+1)?> list-reset ">
					<?endif;?>
				<?else:?>
					<li class="item_<?=$arItem["DEPTH_LEVEL"]?> submenu-<?=($menuTop?"2":"1");?> <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
	                    <a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>">
							<span class="a-wrap"><?=$arItem["TEXT"]?></span>
							<i class="png-arr-menu icon"></i>
						</a>
						<div class="submenu">
							<ul class="menu_level_<?=($arItem["DEPTH_LEVEL"]+1)?> list-reset">
				<?endif;?>
			<?else:?>
				<?if($bHasSelected):?>
					<?if ($childSelected) :?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
							<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>">
								<span class="a-wrap"><?=$arItem["TEXT"]?></span>
								<?if(!$menuTop):?>
									<i class="png-arr-right icon"></i>
								<?endif;?>
							</a>
							<div class="submenu ">
	                        	<ul class="menu_level_<?=($arItem["DEPTH_LEVEL"]+1)?> list-reset">
					<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
							<span>
								<span class="a-wrap"><?=$arItem["TEXT"]?></span>
								<?if(!$menuTop):?>
									<i class="png-arr-right icon"></i>
								<?endif;?>
							</span>
							<div class="submenu ">
                            	<ul class="menu_level_<?=($arItem["DEPTH_LEVEL"]+1)?> list-reset">
					<?endif;?>
				<?else:?>
					<li class="item_<?=$arItem["DEPTH_LEVEL"]?>  <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
						<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>">
							<span><?=$arItem["TEXT"]?></span>
							<?if(!$menuTop):?>
								<i class="png-arr-right icon"></i>
							<?endif;?>
						</a>
						<div class="submenu ">
                           <ul class="menu_level_<?=($arItem["DEPTH_LEVEL"]+1)?> list-reset">
				<?endif;?>
			<?endif;?>
		<?else:
			if ($arItem["PERMISSION"] > "D"):
					$path_cur = str_replace(".php", "/", $arItem["LINK"]);
					$path_cur = explode("/", $path_cur);
					$countPath_cur = count($path_cur);
				?>
					<?if($bHasSelected):
						if($countPath > $countPath_cur):?>
							<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
								<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
							</li>
						<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
							<span><?=$arItem["TEXT"]?></span>
						</li>
						<?endif;?>
					<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
							<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
						</li>
					<?endif;?>
				<?/*endif;*/?>
			<?endif;?>
		<?endif;?>
<?
$previousTop = $menuTop;
$previousLevel = $arItem["DEPTH_LEVEL"];
	endforeach;

	if ($previousLevel > 1):
		echo str_repeat("</ul></div></li>", ($previousLevel-1) );
	endif;
?>
</ul>
<script>
	!function () {
		var menuDrop3 = {

			//Width submenu menu-drop
			setWidth: function () {
				this.menu = $('.menu-drop-3');
				if (this.menu.length) {
					this.subMenu = this.menu.find('.submenu-2').children('.submenu');
					if (this.subMenu.length) {
						this.subMenu.width(this.menu.outerWidth());
					}
				}
			},

			init: function () {
				this.window = $(window);

				$(function () {
					menuDrop3.setWidth();
				});
				this.window.on('load', function () {
					menuDrop3.setWidth();
				});
				this.window.on('resize', function () {
					menuDrop3.setWidth();
				});
			}
		};
		menuDrop3.init();
	}();
</script>