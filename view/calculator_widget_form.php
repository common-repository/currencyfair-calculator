<p>
    <label for="<?php echo $this->get_field_id('widget_size'); ?>"><?php cf_echo_msg('calculator_input_select_widget_size'); ?></label>
    <select id="<?php echo $this->get_field_id('widget_size'); ?>" class="widefat" name="<?php echo $this->get_field_name('widget_size'); ?>">
        <?php foreach ($size_options as $size_option) { ?>
            <option
                value="<?php echo $size_option['value']; ?>"
                <?php echo $instance['widget_size'] === $size_option['value'] ? 'selected' : ''; ?>
            ><?php echo $size_option['display']; ?></option>
        <?php } ?>
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id('affiliate_url'); ?>"><?php cf_echo_msg('calculator_input_select_affiliate_url'); ?></label>
    <br />
    <small style="opacity: 0.7"><?php cf_echo_msg('form_affiliate_url_description'); ?></small>
    <input id="<?php echo $this->get_field_id('affiliate_url'); ?>" class="widefat" name="<?php echo $this->get_field_name('affiliate_url'); ?>" type="text" value="<?php echo $instance['affiliate_url']; ?>">
</p>
