<div class="wrap">
<div id="post-body" class="metabox-holder columns-z">
<div id="post-body-content">
<div class="postbox">
<div class="inside">
<h2>Hello Cricket 🏏</h2>
<strong><p>✅ Live Cricket Score Plugin Shortcode &rArr; <code>[hellocricket]</code></p></strong>
<strong><p>✅ Support (For Updates and Changelogs) - <a rel="nofollow noopener noreferrer" href="https://github.com/mskian/hello-cricket" target="_blank">Connect Now</a></P></strong>
<br>
<strong><P>➡ Just Enter the Live Match Score URL From - https://www.cricbuzz.com/cricket-match/live-scores</P></strong>
<br>
<form method="post" action="options.php">
<?php settings_fields('hellocric_mskc_topt'); ?>
<strong><p>Enter Live Match URL 🍔</p></strong>
<input type="text" name="hellocric_match_url" class="regular-text" value="<?php echo get_option('hellocric_match_url'); ?>" />
<strong><p>Background Color 🍔</p></strong>
<input type="text" name="hellocri_bg_color" class="hellocri-color-field" data-default-color="#7158e2" value="<?php echo get_option('hellocri_bg_color'); ?>" />
<strong><p>Text Color 🍔</p></strong>
<input type="text" name="hellocri_text_color" class="hellocri-color-field" data-default-color="#ffffff" value="<?php echo get_option('hellocri_text_color'); ?>" />
<?php submit_button();?>
</form>
</div>
</div>
</div>
</div>
</div>