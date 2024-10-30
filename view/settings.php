<div class="wrap" id="currencyfair-main">

    <div class="notice" style="display:none"></div>

    <form class="cf_wrap cf_text_align_center" method="post" action="options.php">
        <p style="text-align: left;"><?php cf_echo_msg('form_secret_key_description'); ?> <a href="https://www.currencyfair.com/affiliate-program/">https://www.currencyfair.com/affiliate-program</a></p>

        <br />

        <?php settings_fields('currencyfair-settings-group'); ?>
        <?php do_settings_sections('currencyfair-settings-group'); ?>
        <input placeholder="<?php cf_echo_msg('placeholder_secret_key'); ?>" type="text" name="currencyfair_account_secret_key" value="<?php echo $secret_key; ?>" size="50" />
        <input type="submit" class="button-primary" value="<?php cf_echo_msg('button_save_secret_key'); ?>" />
    </form>

</div>
