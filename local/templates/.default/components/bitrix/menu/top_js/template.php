<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult)):
$path = str_replace(".php", "/", $APPLICATION->GetCurPage(false));
$path = explode("/", $path);
$countPath = count($path);
?>
<ul class="menu-head-2__level-1 list-reset">
	<?foreach($arResult as $key => $arItem):
		if ($arItem['PARAMS']['HIDE'] == 'Y'){
			continue;
			}
		if ($arItem["SELECTED"]):?>
			<li class="menu-head-2__item-<?=$arItem['DEPTH_LEVEL']?> active">
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
			<li class="menu-head-2__item-<?=$arItem['DEPTH_LEVEL']?>">
				<a <?if($arItem["PARAMS"]['TARGET_BLANK'] == 'Y'):?>target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a>
			</li>	
		<?endif;
	endforeach;?>
	<li class="menu-head-2__item-1 menu-head-2__item-1--submenu"><span><span class="menu-head-2__inner"><?=GetMessage("DB_MENU_ITEM_MORE")?></span> <i class="menu-head-2__arrow"></i></span>
		<div class="menu-head-2__wrap">
			<div class="menu-head-2__submenu"></div>
		</div>
	</li>
</ul>
<?endif;?>

