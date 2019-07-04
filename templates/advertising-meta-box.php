
<fieldset class="with-border margin-bottom-8px">
  <legend><?=__('Dimension', 'ads-made-simple')?></legend>
  <div>
    <label><?=__('Width x Height (pixel)', 'ads-made-simple')?></label><br/>
    <input type="number" value="<?=$advertising['width']?>" class="small-number" name="advertising_width"> x
    <input type="number" value="<?=$advertising['height']?>" class="small-number" name="advertising_height">
  </div>
</fieldset>

<?php for ($i = 0; $i < 3; $i++) { ?>
  <fieldset class="with-border <?= $i < 2 ? 'margin-bottom-8px' : '' ?>">
    <legend><?=__('Banner', 'ads-made-simple')?> #<?=$i+1?></legend>
    <div>
      <label><?=__('Picture', 'ads-made-simple')?></label>
      <div class="input-border">
        <img src="<?=$advertising['bannerSrc'][$i]?>" width="<?=$advertising['width']?>" height="<?=$advertising['height']?>">
        <input type="hidden" value="<?=$advertising['bannerId'][$i]?>" name="advertising_banner_id_<?=$i?>">
        <input type="hidden" value="<?=$advertising['bannerSrc'][$i]?>" name="advertising_banner_src_<?=$i?>">
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
      <input type="url" value="<?=$advertising['bannerLink'][$i]?>" class="full-width" name="advertising_banner_link_<?=$i?>">
    </div>
  </fieldset>
<?php } ?>
