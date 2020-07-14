<?php
$data = (apply_filters('mam-property-form-data', ''));
?>
<div class="mam-property-form-container">
    <form method="get" action="<?php echo get_post_type_archive_link('mam-property'); ?>">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="property_type"><?php echo _e('Property Type', 'mam-properties'); ?>:</label>
                    <select id="property_type" name="property_type" class="form-control">
                        <option value=""><?php _e('Any', 'mam-properties'); ?></option>
                        <?php foreach ($data['property_type'] as $option) { ?>
                            <?php if (isset($_GET['property_type']) && $_GET['property_type'] == $option) { ?>
                                <option selected value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="status"><?php echo _e('Property Status', 'mam-properties'); ?>:</label>
                    <select id="status" name="status" class="form-control">
                        <option value=""><?php _e('Any', 'mam-properties'); ?></option>
                        <?php foreach ($data['status'] as $option) { ?>
                            <?php if (isset($_GET['status']) && $_GET['status'] == $option) { ?>
                                <option selected value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="bts"><?php echo _e('BTS', 'mam-properties'); ?>:</label>
                    <select id="bts" name="bts" class="form-control">
                        <option value=""><?php _e('Any', 'mam-properties'); ?></option>
                        <?php foreach ($data['bts'] as $option) { ?>
                            <?php if (isset($_GET['bts']) && $_GET['bts'] == $option) { ?>
                                <option selected value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="location"><?php echo _e('Location', 'mam-properties'); ?>:</label>
                    <select id="location" name="location" class="form-control">
                        <option value=""><?php _e('Any', 'mam-properties'); ?></option>
                        <?php foreach ($data['location'] as $option) { ?>
                            <?php if (isset($_GET['location']) && $_GET['location'] == $option) { ?>
                                <option selected value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="pricefrom"><?php echo _e('Price from', 'mam-properties'); ?>:</label>
                    <select id="pricefrom" name="pricefrom" class="form-control">
                        <option value=""><?php _e('Any', 'mam-properties'); ?></option>
                        <?php foreach ($data['price-from'] as $key => $option) { ?>
                            <?php if (isset($_GET['pricefrom']) && $_GET['pricefrom'] == $key) { ?>
                                <option selected value="<?php echo $key; ?>"><?php echo $option; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $key; ?>"><?php echo $option; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="priceto"><?php echo _e('Price to', 'mam-properties'); ?>:</label>
                    <select id="priceto" name="priceto" class="form-control">
                        <option value=""><?php _e('Any', 'mam-properties'); ?></option>
                        <?php foreach ($data['price-to'] as $key => $option) { ?>
                            <?php if (isset($_GET['priceto']) && $_GET['priceto'] == $key) { ?>
                                <option selected value="<?php echo $key; ?>"><?php echo $option; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $key; ?>"><?php echo $option; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="bedrooms"><?php echo _e('Bedrooms', 'mam-properties'); ?>:</label>
                    <select id="bedrooms" name="bedrooms" class="form-control">
                        <option value=""><?php _e('Any', 'mam-properties'); ?></option>
                        <?php foreach ($data['bedrooms'] as $option) { ?>
                            <?php if (isset($_GET['bedrooms']) && $_GET['bedrooms'] == $option) { ?>
                                <option selected value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-search"><?php echo _e('Search', 'mam-properties'); ?></button>
                </div>
            </div>

        </div>
    </form>
</div>
