<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
//echo '<pre>'; print_r($arResult); echo '</pre>';
if (count($arResult) < 1)
	return;

$path = str_replace(".php", "/", $APPLICATION->GetCurPage(false));
$path = explode("/", $path);
$countPath = count($path);

$bManyIblock = array_key_exists("IBLOCK_ROOT_ITEM", $arResult[0]["PARAMS"]);
$k=1;
?>

<ul class="menu_level_1 list-reset break-word">
<?
$previousLevel = 0;
foreach($arResult as $key => $arItem):
	$flgTarget = false;
	if(strpos($arItem["LINK"], '#print') !== false){
		$arItem["LINK"] = '#print';
		$flgTarget = true;
	}
	if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
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
	<?if ($arItem['DEPTH_LEVEL'] == 1) :?>
		<?if($bHasSelected):?>
			<?if ($childSelected) :?>
			<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
				<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>" title="<?=htmlspecialcharsEx($arItem["TEXT"])?>"><?=$arItem["TEXT"]?></a>
				<a class="icon " data-toggle="collapse" href="#accordion-m-<?=$k?>"></a>
					<div id="accordion-m-<?=$k?>" class="collapse in">
						<ul class="menu_level_<?=$arItem["DEPTH_LEVEL"]+1?> list-reset">
			<?else:?>
				<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
					<span title="<?=htmlspecialcharsEx($arItem["TEXT"])?>"><?=$arItem["TEXT"]?></span>
					<a class="icon " data-toggle="collapse" href="#accordion-m-<?=$k?>"></a>
						<div id="accordion-m-<?=$k?>" class="collapse in">
							<ul class="menu_level_<?=$arItem["DEPTH_LEVEL"]+1?> list-reset">
			<?endif;?>
		<?else:?>
			<li class="item_<?=$arItem["DEPTH_LEVEL"]?> <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
				<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>" title="<?=htmlspecialcharsEx($arItem["TEXT"])?>"><?=$arItem["TEXT"]?></a>
				<a class="icon collapsed" data-toggle="collapse" href="#accordion-m-<?=$k?>"></a>
					<div id="accordion-m-<?=$k?>" class="collapse">
						<ul class="menu_level_<?=$arItem["DEPTH_LEVEL"]+1?> list-reset">
		<?endif;?>
	<?else:?>
		<?if($bHasSelected):?>
			<?if ($childSelected) :?>
				<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
					<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>" title="<?=htmlspecialcharsEx($arItem["TEXT"])?>" ><?=$arItem["TEXT"]?></a>
					<a class="icon collapsed" data-toggle="collapse" href="#accordion-m-<?=$k?>"></a>
						<div id="accordion-m-<?=$k?>" class="collapse">
							<ul class="menu_level_<?=$arItem["DEPTH_LEVEL"]+1?> list-reset">
			<?else:?>
				<li class="item_<?=$arItem["DEPTH_LEVEL"]?> active  mm-opened <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
					<span title="<?=htmlspecialcharsEx($arItem["TEXT"])?>" ><?=$arItem["TEXT"]?></span>
					<a class="icon collapsed" data-toggle="collapse" href="#accordion-m-<?=$k?>"></a>
						<div id="accordion-m-<?=$k?>" class="collapse">
							<ul class="menu_level_<?=$arItem["DEPTH_LEVEL"]+1?> list-reset">
			<?endif;?>
		<?else:?>
			<li class="item_<?=$arItem["DEPTH_LEVEL"]-1?> <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
				<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>" title="<?=htmlspecialcharsEx($arItem["TEXT"])?>"><?=$arItem["TEXT"]?></a>
				<a class="icon collapsed" data-toggle="collapse" href="#accordion-m-<?=$k?>"></a>
					<div id="accordion-m-<?=$k?>" class="collapse">
						<ul class="menu_level_<?=$arItem["DEPTH_LEVEL"]+1?> list-reset">
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
				<li class="item_<?=$arItem["DEPTH_LEVEL"]-1?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
					<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>"  title="<?=htmlspecialcharsEx($arItem["TEXT"])?>"><?=$arItem["TEXT"]?></a>
				</li>
			<?else:?>
				<li class="item_<?=$arItem["DEPTH_LEVEL"]-1?> active <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
					<span title="<?=htmlspecialcharsEx($arItem["TEXT"])?>"><?=$arItem["TEXT"]?></span>
				</li>
			<?endif;?>
		<?else:?>
			<li class="item_<?=$arItem["DEPTH_LEVEL"]-1?> <?if(isset($arItem['PARAMS']['class'])):?><?=$arItem['PARAMS']['class']?><?endif;?>">
				<a <?if($flgTarget):?> target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>"  title="<?=htmlspecialcharsEx($arItem["TEXT"])?>"><?=$arItem["TEXT"]?></a>
			</li>
		<?endif;?>
			<?/*endif;*/?>
		<?endif;?>
	<?endif;?>
	<?
	$previousLevel = $arItem["DEPTH_LEVEL"];
	$k++;endforeach;

if ($previousLevel > 1):
	echo str_repeat("</ul></div></li>", ($previousLevel-1) );
endif;
?>
	</ul>

<?/*/?><!--pre><?=$countPath?></pre--><?//*/?><?/*/?><!--pre><?print_r($path)?></pre--><?//*/?><?/*/?><!--pre><?print_r($arResult)?></pre--><?//*/?>