<div class="currencyfair wrap">

    <?php if ($access_token) { ?>
        <div class="notice updated"><p><?php cf_echo_msg('notice_access_token_valid'); ?></p></div>
    <?php } else { ?>
        <div class="notice error"><p><?php cf_echo_msg('notice_access_token_invalid'); ?></p></div>
    <?php } ?>

    <p class="description"><?php cf_echo_msg('calculator_widget_page_description'); ?></p>

    <div id="update_iframe" class="cf_wrap">
        <form>
            <table class="form-table">

                <tr class="form-field form-required">
                    <th scope="row"><label for="widget_size"><?php cf_echo_msg('calculator_input_select_widget_size'); ?></label></th>
                    <td>
                        <select id="widget_size" name="widget_size" style="width:100%;">
                            <?php foreach ($size_options as $size_option) { ?>
                                <option value="<?php echo $size_option['value']; ?>"><?php echo $size_option['display']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<div class="currencyfair wrap">
    <div class="cf_wrap iframe_container cf_text_align_center">
        <iframe src="https://www.currencyfair.com/banners/pap/calculator/<?php echo $size_options[0]['value']; ?>.html?token=<?php echo $access_token; ?>" name="currencyfair-calculator-widget" width="<?php echo $size_options[0]['x']; ?>" height="<?php echo $size_options[0]['y']; ?>" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe>
    </div>
</div>
