<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);

$bHasPicture = is_array($arResult['PREVIEW_IMG']);
$parent = $component->GetParent();

if(strlen($arResult['PROPERTIES']['POST']['VALUE'])>0){
	$post = true;
}
if(strlen($arResult['PROPERTIES']['MAIL']['VALUE'])>0){
	$mail = true;
}
if(is_array($arResult['PROPERTIES']['INFO']['VALUE'])){
	$info = true;
}
if(strlen($arResult["PREVIEW_TEXT"])>0){
	$text = true;
}


?>
<div class="b-element mb_3" id="element-<?=$arResult['ID']?>" >
	<?if($bHasPicture && $arParams["DISPLAY_DETAIL_PICTURE"] != "N"):?>
		<div class="<?if($arParams["DISPLAY_PICTURE_FULL_WIDTH"] != 'Y'):?>fl-img<?else:?>mb_2<?endif;?>">
			<img src="<?=$arResult['PREVIEW_IMG']['SRC']?>" alt="<?=$arResult['PREVIEW_IMG']['ALT']?>" />
		</div>
	<?endif;?>

	<div class="descr mb_2">
		<div class="caption-text">
		<?if($post):?>
			<p><?=$arResult['PROPERTIES']['POST']['VALUE'];?></p>
		<?endif;?>
		<?foreach($arResult['PROPERTIES']['INFO']['VALUE'] as $num => $arInfo):?>
			<p><?=($arResult['PROPERTIES']['INFO']['DESCRIPTION'][$num]?$arResult['PROPERTIES']['INFO']['DESCRIPTION'][$num].': ':"")?><?=$arInfo?></p>
		<?endforeach;?>
		<?if($mail):?>
			<p><?if($arResult['PROPERTIES']['MAIL']['DESCRIPTION']):?>
					<?=$arResult['PROPERTIES']['MAIL']['DESCRIPTION'];?>:
				<?endif;?>
				<a href="mailto:<?=$arResult['PROPERTIES']['MAIL']['VALUE'];?>" itemprop="email"><?=$arResult['PROPERTIES']['MAIL']['VALUE'];?></a>
			</p>
		<?endif;?>
		</div>
		<?if($arResult["PREVIEW_TEXT"]):?>
			<?if($arResult['PREVIEW_TEXT_TYPE'] == 'html'):?><?=$arResult["PREVIEW_TEXT"]?><?else:?><p><?=$arResult["PREVIEW_TEXT"]?></p><?endif;?>
			<div class="clear"></div>
		<?endif;?>
		<?if($arResult["DETAIL_TEXT"]):?>
			<?if($arResult['DETAIL_TEXT_TYPE'] == 'html'):?><?=$arResult["~DETAIL_TEXT"]?><?else:?><p><?=$arResult["~DETAIL_TEXT"]?></p><?endif;?>
			<div class="clear"></div>
		<?endif;?>
	</div>
</div>

<?/*/?><pre><?print_r($arParams)?></pre><?//*/?>
<?/*/?><pre><?print_r($arResult['VIDEO']['COMPONENT']['NAME'])?></pre><?//*/?>