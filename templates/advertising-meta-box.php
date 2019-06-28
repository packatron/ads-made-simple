
<fieldset class="with-border margin-bottom-8px">
  <legend><?=__('Dimension', 'ads-made-simple')?></legend>
  <div>
    <label><?=__('Width x Height (pixel)', 'ads-made-simple')?></label><br/>
    <input type="number" value="<?=$advertisingWidth?>" class="small-number" name="advertising_width"> x
    <input type="number" value="<?=$advertisingHeight?>" class="small-number" name="advertising_height">
  </div>
</fieldset>

<?php for ($i = 0; $i < 3; $i++) { ?>
  <fieldset class="with-border <?= $i < 2 ? 'margin-bottom-8px' : '' ?>">
    <legend><?=__('Banner', 'ads-made-simple')?> #<?=$i+1?></legend>
    <div>
      <label><?=__('Picture', 'ads-made-simple')?></label>
      <div class="input-border">
        <img src="<?=$advertisingBannerSrc[$i]?>" width="<?=$advertisingWidth?>" height="<?=$advertisingHeight?>">
        <input type="hidden" value="<?=$adsImageId?>" name="advertising_banner_id_<?=$i?>">
        <button type="button" class="button ads-made-simple-banner-select">
            <?=__('Select Banner', 'ads-made-simple')?>
        </button>
        <button type="button button-danger" class="button ads-made-simple-banner-remove">
            <?=__('Remove Banner', 'ads-made-simple')?>
        </button>
      </div>
    </div>
    <div>
      <label><?=__('Link address', 'ads-made-simple')?></label>
      <input type="url" value="<?=$advertisingBannerLink[$i]?>" class="full-width" name="advertising_banner_url_<?=$i?>">
    </div>
  </fieldset>
<?php } ?>






