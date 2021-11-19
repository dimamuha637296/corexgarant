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

	<div class="accordion">
		<div id="menu-accordion" class="acc-group">
	<?
	$previousLevel = 0;
	$j = 1;
	foreach ($arResult as $key => $arItem):
	$flgTarget = false;
	if (strpos($arItem["LINK"], '#print') !== false) {
		$arItem["LINK"] = '#print';
		$flgTarget = true;
	}
	//echo $previousLevel;
	if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
		if($arItem['DEPTH_LEVEL'] == "1"):
			if($previousLevel > 1):
				echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]-1));
				echo "</ul></div></div></div></div>";
			endif;
		elseif($previousLevel > 2):
			echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		endif;
	endif;
	$bHasSelected = $arItem['SELECTED'];
	if ($arItem["IS_PARENT"]):
	$i = $key;

	$childSelected = false;

	while ($arResult[++$i]['DEPTH_LEVEL'] > $arItem['DEPTH_LEVEL']) {
		if ($arResult[$i]['SELECTED']) {
			$bHasSelected = $childSelected = true;
			break;
		}
	}?>
	<?if ($arItem['DEPTH_LEVEL'] == 1) :?>
		<?if($bHasSelected):?>
			<?if ($childSelected) :?>
			<div class="panel">
				<div class="acc-heading">
					<a href="<?=$arItem["LINK"]?>" class="link level-<?=$arItem["DEPTH_LEVEL"]?> active">
						<span><?=$arItem["TEXT"]?></span>
					</a>
					<a href="#accordion-menu-<?=$j?>" data-toggle="collapse" data-parent="#menu-accordion" class="open-menu"></a>
				</div>
				<div id="accordion-menu-<?=$j?>" class="collapse in">
					<div class="acc-body">
						<div class="list-wrap">
							<ul class="level-<?=$arItem["DEPTH_LEVEL"]+1?> list-reset">
			<?else:?>
				<div class="panel">
					<div class="acc-heading">
						<span class="link level-<?=$arItem["DEPTH_LEVEL"]?> active">
							<?=$arItem["TEXT"]?>
						</span>
						<a href="#accordion-menu-<?=$j?>" data-toggle="collapse" data-parent="#menu-accordion" class="open-menu"></a>
					</div>
					<div id="accordion-menu-<?=$j?>" class="collapse in">
						<div class="acc-body">
							<div class="list-wrap">
								<ul class="level-<?=$arItem["DEPTH_LEVEL"]+1?> list-reset">
			<?endif;?>
		<?else:?>
			<div class="panel">
				<div class="acc-heading">
					<a href="<?=$arItem["LINK"]?>" class="link level-<?=$arItem["DEPTH_LEVEL"]?> ">
						<span><?=$arItem["TEXT"]?></span>
					</a>
					<a href="#accordion-menu-<?=$j?>" data-toggle="collapse" data-parent="#menu-accordion" class="open-menu collapsed"></a>
				</div>
				<div id="accordion-menu-<?=$j?>" class="collapse">
					<div class="acc-body">
						<div class="list-wrap">
							<ul class="level-<?=$arItem["DEPTH_LEVEL"]+1?> list-reset">

		<?endif;?>
		<?else:?>
			<?if($bHasSelected):?>
					<?if ($childSelected) :?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
							<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>">
								<?=$arItem["TEXT"]?>
							</a>
							<ul class="level-<?=($arItem["DEPTH_LEVEL"]+1)?>">
					<?else:?>
						<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
							<span><?=$arItem["TEXT"]?></span>
							<ul class="level-<?=($arItem["DEPTH_LEVEL"]+1)?>">
					<?endif;?>
				<?else:?>
					<li class="item_<?=$arItem["DEPTH_LEVEL"]?>  <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
						<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>">
							<?=$arItem["TEXT"]?>
						</a>
						<ul class="level-<?=($arItem["DEPTH_LEVEL"]+1)?> ">
				<?endif;?>
			<?endif;?>
	<?else:?>
			<?if ($arItem['DEPTH_LEVEL'] == 1) :?>
				<?if ($arItem["PERMISSION"] > "D"):
					$path_cur = str_replace(".php", "/", $arItem["LINK"]);
					$path_cur = explode("/", $path_cur);
					$countPath_cur = count($path_cur);
				?>
					<?if($bHasSelected):
						if($countPath > $countPath_cur):?>
							<div class="panel">
								<div class="acc-heading active">
									<a href="<?=$arItem["LINK"]?>" class="link level-<?=$arItem["DEPTH_LEVEL"]?> active">
										<?=$arItem["TEXT"]?>
									</a>
								</div>
							</div>
						<?else:?>
							<div class="panel">
								<div class="acc-heading active">
									<span class="link level-<?=$arItem["DEPTH_LEVEL"]?>">
										<?=$arItem["TEXT"]?>
									</span>
								</div>
							</div>
						<?endif;?>
					<?else:?>
						<div class="panel">
							<div class="acc-heading">
								<a href="<?=$arItem["LINK"]?>" class="link level-<?=$arItem["DEPTH_LEVEL"]?>">
									<?=$arItem["TEXT"]?>
								</a>
							</div>
						</div>
					<?endif;?>
				<?endif;?>
		<?else:?>
			<?if ($arItem["PERMISSION"] > "D"):
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
			<?endif;?>
		<?endif;?>
	<?endif;?>
	<?
	$previousLevel = $arItem["DEPTH_LEVEL"];
	$j=$j+1;
	endforeach;

	if($previousLevel != 1):
		if ($previousLevel > 1):
			echo str_repeat("</ul></li>", ($previousLevel-2) );
			echo "</ul></div></div></div></div>";
		else:
			echo "</ul></div></div></div></div>";
		endif;
	endif;
	?>
	</div>
</div>

