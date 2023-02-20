<?php
/*
Plugin Name: WC Checkout Fields for WooCommerce
Description: Custom Checkout Fields for WooCommerce is a plugin that allows you to add extra fields to the checkout page in WooCommerce. You can add fields for things like customer notes, delivery instructions, or custom product options.
Version: 1.0
Author: George Hawthorne
*/
/******
 *
 * CUSTOM FIELDS
 * Add the custom fields to the product list item in the checkout
 ******/

add_filter('woocommerce_checkout_cart_item_quantity', 'add_suburb_checkout_field_to_product_list_item', 1, 3);
function add_suburb_checkout_field_to_product_list_item($product_quantity, $cart_item, $cart_item_key)
{
    ob_start();
    // Get the suburb value, if it exists
    $domain = 'woocommerce';
    $product = $cart_item['data'];
    $price = $product->get_price();
    $output = '';
    ?>
    <div class="wrap-fields">
        <h4>Recipient Information</h4>
        <div class="name">
            <?php
            $output .= woocommerce_form_field('item_first_name_' . $cart_item_key, array(
                'type' => 'text',
                'label' => __('First Name', $domain),
                'class' => array('save-data'),
                'placeholder' => 'Enter your First Name',
                'required' => true,
                'value' => isset($cart_item['item_first_name']) ? $cart_item['item_first_name'] : '',
            ));
            $output .= woocommerce_form_field('item_last_name_' . $cart_item_key, array(
                'type' => 'text',
                'label' => __('Last Name', $domain),
                'class' => array('save-data'),
                'placeholder' => 'Enter your Last Name',
                'required' => true,
                'value' => isset($cart_item['item_last_name']) ? $cart_item['item_last_name'] : '',
            ));
            ?>
        </div>
        <div class="address">
            <?php
            $output .= woocommerce_form_field('item_street_address_' . $cart_item_key, array(
                'type' => 'text',
                'label' => __('Street Address', $domain),
                'class' => array('save-data'),
                'placeholder' => 'House number and street name',
                'required' => true,
                'value' => isset($cart_item['item_street_address']) ? $cart_item['item_street_address'] : '',
            ));
            $output .= woocommerce_form_field('item_street_address_two_' . $cart_item_key, array(
                'type' => 'text',
                'label' => '',
                'class' => array('save-data'),
                'placeholder' => 'Apartment, suite, unit, etc. (optional)',
                'value' => isset($cart_item['item_street_address_two']) ? $cart_item['item_street_address_two'] : '',
            ));
            $output .= woocommerce_form_field('item_post_code_' . $cart_item_key, array(
                'type' => 'text',
                'label' => __('Post Code', $domain),
                'class' => array('save-data'),
                'placeholder' => 'Enter your Post Code',
                'required' => true,
                'value' => isset($cart_item['item_post_code']) ? $cart_item['item_post_code'] : '',
            ));
            $output .= woocommerce_form_field('phone_number_' . $cart_item_key, array(
                'type' => 'tel',
                'label' => __('Recipient Phone Number', $domain),
                'class' => array('save-data'),
                'required' => true,
                'placeholder' => 'Enter the recipient\'s phone number',
                'validate' => array('phone'),
                'value' => isset($cart_item['phone_number']) ? $cart_item['phone_number'] : '',
            ));
            $field_name = $cart_item_key;
            $chosen_suburb = WC()->session->get('chosen_suburb');
            $chosen = isset($chosen_suburb[$cart_item_key]) ? $chosen_suburb[$cart_item_key] : '';
            $field_id = 'suburb-' . $cart_item_key;
            $output .= woocommerce_form_field($field_name, array(
                'type' => 'select',
                'class' => array('suburb-dropdown'),
                'options' => array(
                    '' => __("Choose a suburb option ..."),
                    'Shop Pickup' => __("Shop Pickup", $domain),
                    'Aeroglen' => sprintf(__("Aeroglen (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Aloomba' => sprintf(__("Aloomba (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Arriga' => sprintf(__("Arriga (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Atherton' => sprintf(__("Atherton (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Babinda' => sprintf(__("Babinda (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Bayview Heights' => sprintf(__("Bayview Heights (%s)", $domain), strip_tags(wc_price(25.00))),
                    'Bellenden Ker' => sprintf(__("Bellenden Ker (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Bentley Park' => sprintf(__("Bentley Park (%s)", $domain), strip_tags(wc_price(27.50))),
                    'Biboohra' => sprintf(__("Biboohra (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Bluewater' => sprintf(__("Bluewater(%s)", $domain), strip_tags(wc_price(27.50))),
                    'Bramston Beach' => sprintf(__("Bramston Beach (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Brinsmead' => sprintf(__("Brinsmead (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Buchans Point' => sprintf(__("Buchans Point (%s)", $domain), strip_tags(wc_price(37.50))),
                    'Bungalow' => sprintf(__("Bungalow (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Cairns' => sprintf(__("Cairns (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Cairns CBD' => sprintf(__("Cairns CBD (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Cairns North' => sprintf(__("Cairns North (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Caravonica' => sprintf(__("Caravonica (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Cardwell' => sprintf(__("Cardwell (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Chewko' => sprintf(__("Chewko (%s)", $domain), strip_tags(wc_price(45.00))),
                    'City View' => sprintf(__("City View (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Clifton Beach' => sprintf(__("Clifton Beach (%s)", $domain), strip_tags(wc_price(27.50))),
                    'Craiglie' => sprintf(__("Craiglie (%s)", $domain), strip_tags(wc_price(55.00))),
                    'Danbulla' => sprintf(__("Danbulla (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Deeral' => sprintf(__("Deeral (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Dimbulah' => sprintf(__("Dimbulah (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Earlville' => sprintf(__("Earlville (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Edgehill' => sprintf(__("Edgehill (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Edmonton' => sprintf(__("Edmonton (%s)", $domain), strip_tags(wc_price(27.50))),
                    'Ellis Beach' => sprintf(__("Ellis Beach (%s)", $domain), strip_tags(wc_price(37.50))),
                    'Fishery Falls' => sprintf(__("Fishery Falls (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Forest Gardens' => sprintf(__("Forest Gardens (%s)", $domain), strip_tags(wc_price(25.00))),
                    'Freshwater' => sprintf(__("Freshwater (%s)", $domain), strip_tags(wc_price(20.00))),
                    'Goldsbrough' => sprintf(__("Goldsbrough (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Gordonvale' => sprintf(__("Gordonvale (%s)", $domain), strip_tags(wc_price(38.50))),
                    'Herberton' => sprintf(__("Herberton (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Holloways Beach' => sprintf(__("Holloways Beach (%s)", $domain), strip_tags(wc_price(20.00))),
                    'Innisfail' => sprintf(__("Innisfail (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Kairi' => sprintf(__("Kairi (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Kamerunga' => sprintf(__("Kamerunga (%s)", $domain), strip_tags(wc_price(22.00))),
                    'Kanimbla' => sprintf(__("Kanimbla (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Kewarra Beach' => sprintf(__("Kewarra Beach (%s)", $domain), strip_tags(wc_price(27.50))),
                    'Koah' => sprintf(__("Koah (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Kuranda' => sprintf(__("Kuranda (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Lake Barrine' => sprintf(__("Lake Barrine (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Lake Eachan' => sprintf(__("Lake Eachan (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Lake Placid' => sprintf(__("Lake Placid (%s)", $domain), strip_tags(wc_price(22.00))),
                    'Lower Tully' => sprintf(__("Lower Tully (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Machans Beach' => sprintf(__("Machans Beach (%s)", $domain), strip_tags(wc_price(20.00))),
                    'Mareeba' => sprintf(__("Mareeba (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Malanda' => sprintf(__("Malanda (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Manoora' => sprintf(__("Manoora (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Manunda' => sprintf(__("Manunda (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Millstream' => sprintf(__("Millstream (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Millaa Millaa' => sprintf(__("Millaa Millaa (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Mirriwinni' => sprintf(__("Mirriwinni (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Mission Beach' => sprintf(__("Mission Beach (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Mooroobool' => sprintf(__("Mooroobool (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Mount Malloy' => sprintf(__("Mount Malloy (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Mount Peter' => sprintf(__("Mount Peter (%s)", $domain), strip_tags(wc_price(37.50))),
                    'Mount Sheridan' => sprintf(__("Mount Sheridan (%s)", $domain), strip_tags(wc_price(27.50))),
                    'Mowbray' => sprintf(__("Mowbray (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Mutchilba' => sprintf(__("Mutchilba (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Oak Beach' => sprintf(__("Oak Beach (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Paddys Green' => sprintf(__("Paddys Green (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Palm Cove' => sprintf(__("Palm Cove (%s)", $domain), strip_tags(wc_price(27.50))),
                    'Paradise Palms' => sprintf(__("Paradise Palms (%s)", $domain), strip_tags(wc_price(27.50))),
                    'Port Douglas' => sprintf(__("Port Douglas (%s)", $domain), strip_tags(wc_price(55.00))),
                    'Portsmith' => sprintf(__("Portsmith (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Ravenshoe' => sprintf(__("Ravenshoe (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Redlynch' => sprintf(__("Redlynch (%s)", $domain), strip_tags(wc_price(20.00))),
                    'Redlynch Valley' => sprintf(__("Redlynch Valley (%s)", $domain), strip_tags(wc_price(27.50))),
                    'Smithfield' => sprintf(__("Smithfield (%s)", $domain), strip_tags(wc_price(25.00))),
                    'Smithfield Heights' => sprintf(__("Smithfield Heights (%s)", $domain), strip_tags(wc_price(25.00))),
                    'Southedge' => sprintf(__("Southedge (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Speewah' => sprintf(__("Speewah (%s)", $domain), strip_tags(wc_price(37.50))),
                    'Stratford' => sprintf(__("Stratford (%s)", $domain), strip_tags(wc_price(20.00))),
                    'Tolga' => sprintf(__("Tolga (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Tinaroo' => sprintf(__("Tinaroo (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Trazali' => sprintf(__("Trazali (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Trinty Beach' => sprintf(__("Trinty Beach (%s)", $domain), strip_tags(wc_price(27.50))),
                    'Tully' => sprintf(__("Tully (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Tully Heads' => sprintf(__("Tully Heads (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Walkamin' => sprintf(__("Walkamin (%s)", $domain), strip_tags(wc_price(40.00))),
                    'Wangetti' => sprintf(__("Wangetti (%s)", $domain), strip_tags(wc_price(37.50))),
                    'Westcourt' => sprintf(__("Westcourt (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Whitfield' => sprintf(__("Whitfield (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Woree' => sprintf(__("Woree (%s)", $domain), strip_tags(wc_price(17.50))),
                    'Yarrabah' => sprintf(__("Yarrabah (%s)", $domain), strip_tags(wc_price(45.00))),
                    'Yorkeys Knob' => sprintf(__("Yorkeys Knob (%s)", $domain), strip_tags(wc_price(27.50))),
                    'Yungaburra' => sprintf(__("Yungaburra (%s)", $domain), strip_tags(wc_price(40.00))),
                ),
                'label' => 'Select the suburb:',
                'required' => true
            ), $chosen);
            ?>
        </div>
        <div class="delivery">
            <h4>Delivery Information</h4>
            <div class="date-field_<?php echo $cart_item_key ?>">
                <?php
                $output .= woocommerce_form_field('item_delivery_date_' . $cart_item_key, array(
                    'type' => 'text',
                    'label' => __('Delivery Date', $domain),
                    'required' => true,
                    'class' => array('save-data', 'datepicker', 'datepicker_' . $cart_item_key),
                    'value' => isset($cart_item['item_delivery_date']) ? $cart_item['item_delivery_date'] : '',
                    'autocomplete' => 'off',
                ));
                ?>
            </div>
            <div class="delivery-options-container_<?php echo $cart_item_key ?> " style="display: none;">
                <?php
                $delivery_field_name = 'delivery_option_' . $cart_item_key;
                $delivery_field_id = 'delivery-option-' . $cart_item_key;
                $chosen_delivery_type = WC()->session->get('chosen_delivery_option');
                $chosen_delivery = isset($chosen_delivery_type[$cart_item_key]) ? $chosen_delivery_type[$cart_item_key] : '';
                $output .= woocommerce_form_field($delivery_field_name, array(
                    'type' => 'select',
                    'class' => array('delivery-type'),
                    'options' => array(
                        '' => 'Select Delivery Type',
                        'shop_pickup' => sprintf(__("Shop Pickup", $domain), strip_tags(wc_price(0))),
                        'standard_delivery' => sprintf(__("Standard Delivery", $domain), strip_tags(wc_price(0))),
                        'am_delivery' => sprintf(__("AM Specific Delivery (%s)", $domain), strip_tags(wc_price(15.00))),
                        'pm_delivery' => sprintf(__("PM Specific Delivery (%s)", $domain), strip_tags(wc_price(10.00))),
                        'express_delivery' => sprintf(__("Express Delivery (%s)", $domain), strip_tags(wc_price(25.00))),
                    ),
                    'label' => __('Delivery Type', $domain),
                    'required' => true,
                ), $chosen_delivery);
                ?>
            </div>
        </div>
        <div class="extra-info">
            <h4>Property Infomation</h4>
            <?php
            $output .= woocommerce_form_field('instruct_courier_to_' . $cart_item_key, array(
                'type' => 'select',
                'label' => __('If the recipient is not there?', $domain),
                'class' => array('save-data'),
                'required' => true,
                'options' => array(
                    '' => __('Please select', $domain),
                    'leave-at-the-front-door' => __('Leave at the front door'),
                    'leave-at-reception' => __('Leave at reception'),
                    'return-to-florist-shop-fees-may-apply' => __('Return to florist shop (fees may apply)', $domain),
                ),
            ));
            $output .= woocommerce_form_field('house_type_' . $cart_item_key, array(
                'type' => 'select',
                'label' => __('Is the House/Unit/Apartment gated?', $domain),
                'class' => array('save-data'),
                'required' => true,
                'options' => array(
                    '' => __('Please select', $domain),
                    'yes' => __('Yes'),
                    'no' => __('No'),
                ),
            ));
            ?>
        </div>
        <div class="notes">
            <?php
            $output .= woocommerce_form_field('order_notes_' . $cart_item_key, array(
                'type' => 'textarea',
                'label' => __('Order notes', $domain),
                'class' => array('save-data'),
                'placeholder' => 'Notes about your order, e.g. special notes for delivery.',
                'value' => isset($cart_item['order_notes']) ? $cart_item['order_notes'] : '',
            ));
            ?>
        </div>
    </div>
    <script>
        // Pre-populate input fields with the saved value from local storage
        jQuery(document).ready(function () {
            $('.save-data input').each(function () {
                var inputName = $(this).attr('name');
                $(this).on('input', function () {
                    var inputValue = $(this).val();
                    localStorage.setItem(inputName, inputValue);
                });
                var savedValue = localStorage.getItem(inputName);
                if (savedValue !== null && savedValue !== '') {
                    $(this).val(savedValue);
                }
            });
            $('.save-data select').each(function () {
                var inputName = $(this).attr('name');
                // console.log(inputName);
                $(this).on('change', function () {
                    var inputValue = $(this).val();
                    localStorage.setItem(inputName, inputValue);
                });
                var savedValue = localStorage.getItem(inputName);
                if (savedValue !== null && savedValue !== '') {
                    $(this).val(savedValue);
                }
            });
            $("#<?php echo $cart_item_key ?> option:first-child").attr("disabled", "disabled");
            $("#house_type_<?php echo $cart_item_key ?> option:first-child").attr("disabled", "disabled");
            $("#instruct_courier_to_<?php echo $cart_item_key ?> option:first-child").attr("disabled", "disabled");

        });
        jQuery(document).ready(function () {
            $.ajax({
                url: 'https://worldtimeapi.org/api/timezone/Australia/Brisbane',
                dataType: 'json',
                success: function (data) {
                    now = new Date(data.datetime);
                    hours = now.getHours();
                    minutes = now.getMinutes();
                },
                error: function () {
                    console.log('Error getting current time from World Time API. Falling back to local machine time.');
                    now = new Date();
                    hours = now.getHours();
                    minutes = now.getMinutes();
                },
                complete: function () {
                    var selectedDate = localStorage.getItem('selectedDate_<?php echo $cart_item_key; ?>');

                    // Set the minDate option of the datepicker based on the current time
                    var minDate = hours < 13 ? 0 : 1;
                    // Define options for the datepicker
                    var allowedWeekends = ['2023-05-14'];
                    var disabledDates = ["2023-02-22", "2023-03-01", "2023-03-03"];
                    // Set first option to disabled
                    $("#delivery_option_<?php echo $cart_item_key ?> option:first-child").attr("disabled", "disabled");
                    // Set options
                    var options = {
                        minDate: minDate,
                        firstDay: 1, // Start the week on Monday
                        dateFormat: 'dd/mm/yy', // Australian date format
                        beforeShowDay: function (date) {
                            // Disable weekends, except for specific dates
                            var day = date.getDay();
                            var dateString = $.datepicker.formatDate('yy-mm-dd', date);
                            if (day === 0 || day === 6) {
                                if (allowedWeekends.includes(dateString)) {
                                    return [true];
                                } else {
                                    return [false];
                                }
                            } else if (disabledDates.includes(dateString)) {
                                return [false];
                            }else {
                                return [true];
                            }
                        },
                        onSelect: function (dateText, inst) {
                            // Show the delivery options select when a date is selected

                            $('.delivery-options-container_<?php echo $cart_item_key ?>').show();

                            // LOCAL STORAGE
                            // Get the selected date
                            var selectedDate = $(this).datepicker('getDate');
                            // Format the selected date
                            var selectedDateFormatted = $.datepicker.formatDate('dd/mm/yy', selectedDate);
                            // Store selected date in localStorage
                            localStorage.setItem('selectedDate_<?php echo $cart_item_key; ?>', selectedDateFormatted);

                            var currentDate = now;

                            // Check if selected date is today and it's after 09:00
                            if (selectedDate.getDate() === currentDate.getDate() &&
                                currentDate.getHours() >= 9) {
                                $('#delivery-options_<?php echo $cart_item_key ?> option[value="am_delivery"]').prop('disabled', true).hide();
                            } else {
                                $('#delivery-options_<?php echo $cart_item_key ?> option[value="am_delivery"]').prop('disabled', false).show();
                            }
                            ;
                            // Check if selected date is today and it's after 09:00
                            if (selectedDate.getDate() === currentDate.getDate() &&
                                currentDate.getHours() >= 12) {
                                $('#delivery-options_<?php echo $cart_item_key ?> option[value="standard_delivery"]').prop('disabled', true).hide();
                                $('#delivery-options_<?php echo $cart_item_key ?> option[value="pm_delivery"]').prop('disabled', true).hide();
                            } else {
                                $('#delivery-options_<?php echo $cart_item_key ?> option[value="standard_delivery"]').prop('disabled', false).show();
                                $('#delivery-options_<?php echo $cart_item_key ?> option[value="pm_delivery"]').prop('disabled', false).show();
                            }
                        }
                    };

                    // Initialize the datepicker with the specified options
                    var $datePicker = $(".datepicker_<?php echo $cart_item_key; ?> input");
                    $($datePicker).datepicker(options);

                    $datePicker.datepicker("setDate", selectedDate);
                    if (selectedDate) {
                        $('.delivery-options-container_<?php echo $cart_item_key ?>').show();
                    }
                }
            });
        });

    </script>
    <?php
    $output .= '<div class="product-price" data-original-price="' . $price . '"></div>';
    $output = ob_get_clean();
    // Return the product quantity with the suburb field
    return $product_quantity . $output;
}


/******
 *
 * DELIVERY SUBURB FEE
 *
 ******/
// Ajax script
add_action('wp_footer', 'checkout_suburb_script');
function checkout_suburb_script()
{
    // Only checkout page
    if (is_checkout() && !is_wc_endpoint_url()) :
        WC()->session->__unset('chosen_suburb');
        ?>
        <script type="text/javascript">
            jQuery(function ($) {
                $('form.checkout').on('change', '.suburb-dropdown', function () {
                    var cart_item_key = $(this).find('select').attr('name');
                    var suburb = $(this).find('select').val();

                    $.ajax({
                        type: 'POST',
                        url: wc_checkout_params.ajax_url,
                        data: {
                            'action': 'woo_get_ajax_data',
                            'cart_item_key': cart_item_key,
                            'suburb': suburb
                        },
                        success: function (result) {
                            $('body').trigger('update_checkout');
                        },
                        error: function (error) {
                            console.log(error); // just for testing | TO BE REMOVED
                        }
                    });
                });
            });

        </script>
    <?php
    endif;
}

// Php Ajax (Receiving request and saving to WC session)
add_action('wp_ajax_woo_get_ajax_data', 'woo_get_ajax_data');
add_action('wp_ajax_nopriv_woo_get_ajax_data', 'woo_get_ajax_data');
function woo_get_ajax_data()
{
    if (isset($_POST['suburb'])) {
        $suburb = sanitize_text_field($_POST['suburb']);
        $chosen_suburb = WC()->session->get('chosen_suburb', array());
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        $chosen_suburb[$cart_item_key] = $suburb;
        WC()->session->set('chosen_suburb', $chosen_suburb);
        echo json_encode($suburb);
    }
    die(); // Always at the end (to avoid server error 500)
}

// Add fee
add_action('woocommerce_cart_calculate_fees', 'add_delivery_fee', 20, 1);
function add_delivery_fee($cart)
{
    if (is_admin() && !defined('DOING_AJAX'))
        return;

    $domain = "woocommerce";
    $suburb_fee = WC()->session->get('chosen_suburb');

    $total_cost = 0;
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        $chosen_suburb = WC()->session->get('chosen_suburb');
        $selected_suburb = isset($chosen_suburb[$cart_item_key]) ? $chosen_suburb[$cart_item_key] : '';
        $cost = 0;
        switch ($selected_suburb) {
            case 'Shop Pickup':
                $cost = 0;
                break;
            case 'Aeroglen':
            case 'Brinsmead':
            case 'Bungalow':
            case 'Cairns':
            case 'Cairns CBD':
            case 'Cairns North':
            case 'Caravonica':
            case 'City View':
            case 'Freshwater':
            case 'Holloways Beach':
            case 'Manoora':
            case 'Kanimbla':
            case 'Manunda':
            case 'Portsmith':
            case 'Westcourt':
            case 'Whitfield':
            case 'Woree':
            case 'Edgehill':
            case 'Earlville':
            case 'Mooroobool':
                $cost = 17.50;
                break;
            case 'Machans Beach':
            case 'Redlynch':
            case 'Stratford':
                $cost = 20.00;
                break;
            case 'Kamerunga':
            case 'Lake Placid':
                $cost = 22.00;
                break;
            case 'Bayview Heights':
            case 'Forest Gardens':
            case 'Smithfield':
            case 'Smithfield Heights':
            case 'Whiterock':
                $cost = 25.00;
                break;
            case 'Bentley Park':
            case 'Bluewater':
            case 'Clifton Beach':
            case 'Paradise Palms':
            case 'Palm Cove':
            case 'Trinty Beach':
            case 'Kewarra Beach':
            case 'Yorkeys Knob':
            case 'Edmonton':
            case 'Mount Sheridan':
            case 'Redlynch Valley':
                $cost = 27.50;
                break;
            case 'Buchans Point':
            case 'Ellis Beach':
            case 'Mount Peter':
            case 'Speewah':
            case 'Wangetti':
                $cost = 37.50;
                break;
            case 'Gordonvale':
                $cost = 38.50;
                break;
            case 'Aloomba':
            case 'Atherton':
            case 'Bellenden Ker':
            case 'Deeral':
            case 'Fishery Falls':
            case 'Goldsbrough':
            case 'Kairi':
            case 'Koah':
            case 'Kuranda':
            case 'Lake Barrine':
            case 'Lake Eachan':
            case 'Mareeba':
            case 'Tolga':
            case 'Tinaroo':
            case 'Walkamin':
            case 'Oak Beach':
            case 'Yungaburra':
                $cost = 40.00;
                break;
            case 'Arriga':
            case 'Babinda':
            case 'Biboohra':
            case 'Bramston Beach':
            case 'Cardwell':
            case 'Chewko':
            case 'Danbulla':
            case 'Dimbulah':
            case 'Herberton':
            case 'Innisfail':
            case 'Malanda':
            case 'Millstream':
            case 'Millaa Millaa':
            case 'Mirriwinni':
            case 'Mission Beach':
            case 'Mount Malloy':
            case 'Mowbray':
            case 'Mutchilba':
            case 'Paddys Green':
            case 'Ravenshoe':
            case 'Southedge':
            case 'Trazali':
            case 'Lower Tully':
            case 'Tully':
            case 'Tully Heads':
            case 'Yarrabah':
                $cost = 45.00;
                break;
            case 'Craiglie':
            case 'Port Douglas':
                $cost = 55.00;
                break;
            default;
        }
        $total_cost += $cost;
    }

    if ($total_cost > 0) {
        $cart->add_fee(__("Suburb Delivery Fees", $domain), $total_cost);
    }
}

//add_filter('woocommerce_cart_item_subtotal', 'update_subtotal_for_each_item', 10, 3);
//function update_subtotal_for_each_item($subtotal, $cart_item, $cart_item_key)
//{
//    $chosen_suburb = WC()->session->get('chosen_suburb');
//    $selected_suburb = isset($chosen_suburb[$cart_item_key]) ? $chosen_suburb[$cart_item_key] : '';
//    $cost = 0;
//    switch ($selected_suburb) {
//    }
//
//    $product = $cart_item['data'];
//    $price = $product->get_price();
//    $updated_price = $price + $cost;
//    $updated_subtotal = wc_price($updated_price * $cart_item['quantity']);
//
//    return $updated_subtotal;
//}

/******
 *
 * DELIVERY PRIORITY FEE
 *
 ******/
// Ajax script
add_action('wp_footer', 'checkout_delivery_script');
function checkout_delivery_script()
{
    // Only checkout page
    if (is_checkout() && !is_wc_endpoint_url()) :

        WC()->session->__unset('chosen_delivery_option');
        ?>
        <script type="text/javascript">
            jQuery(function ($) {
                "use strict";
                $('form.checkout').on('change', '.delivery-type', function () {
                    var cart_item_key = $(this).find('select').attr('name');
                    var delivery_option = $(this).find('select').val();
                    const sanitized_key = cart_item_key.replace('delivery_option_', '');
                    $.ajax({
                        type: 'POST',
                        url: wc_checkout_params.ajax_url,
                        data: {
                            'action': 'woo_get_delivery_option_ajax_data',
                            'cart_item_key': sanitized_key,
                            'delivery_option': delivery_option
                        },
                        success: function (result) {
                            $('body').trigger('update_checkout');
                            // var selectedDate = localStorage.getItem('selectedDate_'.content);
                            // console.log(selectedDate);
                        },
                        error: function (error) {
                            console.log(error); // just for testing | TO BE REMOVED
                        }
                    });
                });
            });

        </script>
    <?php
    endif;
}

// Php Ajax (Receiving request and saving to WC session)
add_action('wp_ajax_woo_get_delivery_option_ajax_data', 'woo_get_delivery_option_ajax_data');
add_action('wp_ajax_nopriv_woo_get_delivery_option_ajax_data', 'woo_get_delivery_option_ajax_data');
function woo_get_delivery_option_ajax_data()
{
    if (isset($_POST['delivery_option'])) {
        $delivery_option = sanitize_text_field($_POST['delivery_option']);
        $chosen_delivery_option = WC()->session->get('chosen_delivery_option', array());
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        $chosen_delivery_option[$cart_item_key] = $delivery_option;
        WC()->session->set('chosen_delivery_option', $chosen_delivery_option);
        echo json_encode($delivery_option);
    }
    die(); // Always at the end (to avoid server error 500)
}

// delivery fee
add_action('woocommerce_cart_calculate_fees', 'add_delivery_priority_fee', 20, 1);
function add_delivery_priority_fee($cart)
{
    if (is_admin() && !defined('DOING_AJAX'))
        return;

    $domain = "woocommerce";
    $delivery_fee = 0;
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        $chosen_delivery_option = WC()->session->get('chosen_delivery_option');
        $delivery_type = isset($chosen_delivery_option[$cart_item_key]) ? $chosen_delivery_option[$cart_item_key] : '';
        switch ($delivery_type) {
            case 'standard_delivery':
                $cost = 0;
                break;
            case 'am_delivery':
                $cost = 15.00;
                break;
            case 'pm_delivery':
                $cost = 10.00;
                break;
            case 'express_delivery':
                $cost = 25.00;
                break;
            default:
                $cost = 0;
        }
        $delivery_fee += $cost;
    }
    if ($delivery_fee > 0) {
        $cart->add_fee(__('Delivery Priority Fee', $domain), $delivery_fee);
    }
}

/******
 *
 * ADD FIELDS TO META DATA
 *
 ******/
// Add custom fields to each cart item on checkout page
add_action('woocommerce_checkout_create_order_line_item', 'add_custom_fields_to_order_items', 10, 4);
function add_custom_fields_to_order_items($item, $cart_item_key, $values, $order)
{
    // Get the posted data from the checkout form
    $posted_data = $_POST;

    if (isset($posted_data['item_first_name_' . $cart_item_key])) {
        $first_name = sanitize_text_field($posted_data['item_first_name_' . $cart_item_key]);
        $item->add_meta_data('First Name', $first_name);
    }
    if (isset($posted_data['item_last_name_' . $cart_item_key])) {
        $last_name = sanitize_text_field($posted_data['item_last_name_' . $cart_item_key]);
        $item->add_meta_data('Last Name', $last_name);
    }
    if (isset($posted_data['item_street_address_' . $cart_item_key])) {
        $street_address = sanitize_text_field($posted_data['item_street_address_' . $cart_item_key]);
        $item->add_meta_data('Street Address', $street_address);
    }
    if (isset($posted_data['item_street_address_two_' . $cart_item_key])) {
        $street_address = sanitize_text_field($posted_data['item_street_address_two_' . $cart_item_key]);
        $item->add_meta_data('Street Address Two', $street_address);
    }
    if (isset($posted_data['item_post_code_' . $cart_item_key])) {
        $post_code = sanitize_text_field($posted_data['item_post_code_' . $cart_item_key]);
        $item->add_meta_data('Post Code', $post_code);
    }
    if (isset($posted_data[$cart_item_key])) {
        $suburb_name = sanitize_text_field($posted_data[$cart_item_key]);
        $item->add_meta_data('Suburb Name', $suburb_name);
    }
    if (isset($posted_data['phone_number_' . $cart_item_key])) {
        $phone_number = sanitize_text_field($posted_data['phone_number_' . $cart_item_key]);
        $item->add_meta_data('Phone Number', $phone_number);
    }
    if (isset($posted_data['item_delivery_date_' . $cart_item_key])) {
        $delivery_date = sanitize_text_field($posted_data['item_delivery_date_' . $cart_item_key]);
        $item->add_meta_data('Delivery Date', $delivery_date);
    }
    if (isset($posted_data['delivery_option_' . $cart_item_key])) {
        $delivery_option = sanitize_text_field($posted_data['delivery_option_' . $cart_item_key]);
        $item->add_meta_data('Delivery Option', $delivery_option);
    }
    if (isset($posted_data['instruct_courier_to_' . $cart_item_key])) {
        $courier_instruct = sanitize_text_field($posted_data['instruct_courier_to_' . $cart_item_key]);
        $item->add_meta_data('Courier Instructions', $courier_instruct);
    }
    if (isset($posted_data['house_type_' . $cart_item_key])) {
        $house_type = sanitize_text_field($posted_data['house_type_' . $cart_item_key]);
        $item->add_meta_data('Gated Property', $house_type);
    }
    if (isset($posted_data['order_notes_' . $cart_item_key])) {
        $order_notes = sanitize_text_field($posted_data['order_notes_' . $cart_item_key]);
        $item->add_meta_data('Order notes', $order_notes);
    }
}

    // Add validation to the custom fields during checkout
add_action('woocommerce_checkout_process', 'validate_custom_fields');
function validate_custom_fields()
{
    // Array to keep track of added notices
    $added_notices = array();

    // Loop through each cart item and validate the fields
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

        $first_name = isset($_POST['item_first_name_' . $cart_item_key]) ? sanitize_text_field($_POST['item_first_name_' . $cart_item_key]) : '';
        if (empty($first_name) && !in_array('item_first_name', $added_notices)) {
            wc_add_notice(__('Please enter a <strong>First Name</strong> for each cart item.', 'woocommerce'), 'error');
            $added_notices[] = 'item_first_name';
        }
        $last_name = isset($_POST['item_last_name_' . $cart_item_key]) ? sanitize_text_field($_POST['item_last_name_' . $cart_item_key]) : '';
        if (empty($last_name) && !in_array('item_last_name', $added_notices)) {
            wc_add_notice(__('Please enter a <strong>Last Name</strong> for each cart item.', 'woocommerce'), 'error');
            $added_notices[] = 'item_last_name';
        }
        $street_address = isset($_POST['item_street_address_' . $cart_item_key]) ? sanitize_text_field($_POST['item_street_address_' . $cart_item_key]) : '';
        if (empty($street_address) && !in_array('item_street_address', $added_notices)) {
            wc_add_notice(__('Please enter a <strong>Street Address</strong> for each cart item.', 'woocommerce'), 'error');
            $added_notices[] = 'item_street_address';
        }
        $post_code = isset($_POST['item_post_code_' . $cart_item_key]) ? sanitize_text_field($_POST['item_post_code_' . $cart_item_key]) : '';
        if (empty($post_code) && !in_array('item_post_code', $added_notices)) {
            wc_add_notice(__('Please enter a <strong>Post Code</strong> for each cart item.', 'woocommerce'), 'error');
            $added_notices[] = 'item_post_code';
        }
        $suburb = isset($_POST[$cart_item_key]) ? sanitize_text_field($_POST[$cart_item_key]) : '';
        if (empty($suburb) && !in_array('suburb', $added_notices)) {
            wc_add_notice(__('Please select a <strong>Suburb</strong> for each cart item.', 'woocommerce'), 'error');
            $added_notices[] = 'suburb';
        }
        $phone_number = isset($_POST['phone_number_' . $cart_item_key]) ? sanitize_text_field($_POST['phone_number_' . $cart_item_key]) : '';
        if (empty($phone_number) && !in_array('phone_number', $added_notices)) {
            wc_add_notice(__('Please enter a <strong>Phone Number</strong> for each cart item.', 'woocommerce'), 'error');
            $added_notices[] = 'phone_number';
        }
        $delivery_date = isset($_POST['item_delivery_date_' . $cart_item_key]) ? sanitize_text_field($_POST['item_delivery_date_' . $cart_item_key]) : '';
        if (empty($delivery_date) && !in_array('item_delivery_date', $added_notices)) {
            wc_add_notice(__('Please select a <strong>Delivery Date</strong> for each cart item.', 'woocommerce'), 'error');
            $added_notices[] = 'item_delivery_date';
        }

        $courier_instruct = isset($_POST['instruct_courier_to_' . $cart_item_key]) ? sanitize_text_field($_POST['instruct_courier_to_' . $cart_item_key]) : '';
        if (empty($courier_instruct) && !in_array('instruct_courier_to', $added_notices)) {
            wc_add_notice(__('Please select <strong>Courier Instructions</strong> for each cart item', 'woocommerce'), 'error');
            $added_notices[] = 'instruct_courier_to';
        }
        $house_type = isset($_POST['house_type_' . $cart_item_key]) ? sanitize_text_field($_POST['house_type_' . $cart_item_key]) : '';
        if (empty($house_type) && !in_array('house_type', $added_notices)) {
            wc_add_notice(__('Please select <strong>Property Type</strong> for each cart item', 'woocommerce'), 'error');
            $added_notices[] = 'house_type';
        }
    }
}