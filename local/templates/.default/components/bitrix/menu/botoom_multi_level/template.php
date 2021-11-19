<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
	
		if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
			echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
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
			<?if ($arItem['DEPTH_LEVEL'] == 1) :?>
				<?if($bHasSelected):?>
					<?if ($childSelected) :?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
		                    <a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>" >
								<span><span class="a-wrap"><?=$arItem["TEXT"]?></span></span>
							</a>
							<ul class="menu_level_<?=($arItem["DEPTH_LEVEL"]+1)?> list-reset <?=($arParams['IS_GOR'] == 'Y' ? '' : ' _');?>">
					<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
							<span><span class="a-wrap"><?=$arItem["TEXT"]?></span></span>
							<ul class="menu_level_<?=($arItem["DEPTH_LEVEL"]+1)?> list-reset <?=($arParams['IS_GOR'] == 'Y' ? '' : ' _');?>">
					<?endif;?>
				<?else:?>
					<li class="item_<?=$arItem["DEPTH_LEVEL"]?> <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
	                    <a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>">
							<span class="a-wrap"><?=$arItem["TEXT"]?></span>
						</a>
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
								<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>">
									<?if($arItem['DEPTH_LEVEL'] == '1'):?>
										<span class="a-wrap">
										<?=$arItem["TEXT"]?>
									</span>
									<?else:?>
										<?=$arItem["TEXT"]?>
									<?endif;?>
								</a>
							</li>
						<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
							<?if($arItem['DEPTH_LEVEL'] == '1'):?>
								<span>
									<span class="a-wrap">
											<?=$arItem["TEXT"]?>
									</span>
								</span>
							<?else:?>
								<?=$arItem["TEXT"]?>
							<?endif;?>
						</li>
						<?endif;?>
					<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
							<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>">
								<?if($arItem['DEPTH_LEVEL'] == '1'):?>
									<span class="a-wrap">
										<?=$arItem["TEXT"]?>
									</span>
								<?else:?>
									<?=$arItem["TEXT"]?>
								<?endif;?>
							</a>
						</li>
					<?endif;?>
				<?/*endif;*/?>
			<?endif;?>
		<?endif;?>
<?			
$previousLevel = $arItem["DEPTH_LEVEL"];
	endforeach;

	if ($previousLevel > 1):
		echo str_repeat("</ul></li>", ($previousLevel-1) );
	endif;
?>
</ul>