<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult)):
$path = str_replace(".php", "/", $APPLICATION->GetCurPage(false));
$path = explode("/", $path);
$countPath = count($path);

$delim = array();
$delim[1]=ceil(count($arResult) / 3);
$delim[2]=ceil(count($arResult) / 2);

foreach($delim as $num => $arVal):
?>
	<nav class="footer-uslugi ptsans-r <?=$num == 1 ? 'desktop col-md-15 visible-md' : 'tablet col-sm-14 col-20 hidden-md'?> ">
		<ul class="list-item">
			<?$i=1;foreach($arResult as $key => $arItem):
				if ($arItem["SELECTED"]):?>
					<li class="item arrow _active">
						<?if($arItem['DEPTH_LEVEL'] == 1):
							if(!empty($path[1]) && strpos($arItem["LINK"], $path[$countPath-2]) === false):?>
								<a <?if($arItem["PARAMS"]['TARGET_BLANK'] == 'Y'):?>target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
							<?else:?>
								<span><?=$arItem["TEXT"]?></span>
							<?endif;
							else:?>
							<span><?=$arItem["TEXT"]?></span>
						<?endif;?>
						<i></i>
					</li>	
				<?else:?>	
					<li class="item arrow">
						<a <?if($arItem["PARAMS"]['TARGET_BLANK'] == 'Y'):?>target="_blank"<?endif;?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
						<i></i>
					</li>	
				<?endif;
				if($i % $arVal == 0):?>
					</ul><ul class="list-item">
				<?endif;
			$i++;endforeach;?>
		</ul>
		
	</nav>
<?endforeach;?>
<?endif;?>