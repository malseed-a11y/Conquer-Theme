<div class="product-cards-wrapper">

    <?php
    $settings = $this->get_settings_for_display();

    if (!empty($settings['product_list'])) {
        foreach ($settings['product_list'] as $item) {

            $image_url = !empty($item['product_image']['url']) ? $item['product_image']['url'] : '';
            $title = !empty($item['product_title']) ? $item['product_title'] : '';
            $desc  = !empty($item['product_desc']) ? $item['product_desc'] : '';
            $price = !empty($item['product_price']) ? $item['product_price'] : '';
    ?>
            <section class="styledCard">
                <div class="styledProductImage">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" />
                </div>
                <div class="productInfoWrap">
                    <h2 class="product-title-typocraphy"><?php echo esc_html($title); ?></h2>
                    <p class="product-description-typocraphy"><?php echo esc_html($desc); ?></p>
                    <div class="price"><?php echo esc_html($price); ?> $</div>
                </div>
                <div class="styledBtn">
                    <button class="buyBtn">Buy Now</button>
                    <button type="button" class="favBtn">
                        <img src="https://cdn-icons-png.flaticon.com/512/18/18611.png" alt="star icon" />
                    </button>
                </div>
            </section>
    <?php
        }
    }
    ?>

</div>