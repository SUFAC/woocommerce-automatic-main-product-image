<?php
/*
Plugin Name: Woocommerce Automatic Main Product Image
Plugin URI:
Description: Change Product Main Image by product's gallery thumbnail image during product update(save post).
Version: 0.1
Author: Igor SUFAC
Author URI: https://github.com/SUFAC
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Woocommerce Automatic Main Product Image is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or any later version.
 
Woocommerce Automatic Main Product Image is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Woocommerce Automatic Main Product Image. If not, see http://www.gnu.org/licenses/gpl-3.0.html.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function add_featured_image()
{
    $post = get_post();
    $productId = $post->ID;
    $product_meta = get_post_meta($productId);
    $productGalleryIds = $product_meta["_product_image_gallery"];

    if (!isset($product_meta["_thumbnail_id"]) && !empty($productGalleryIds[0])) {
        set_post_thumbnail($productId, $productGalleryIds[0]);
    } elseif (isset($product_meta["_thumbnail_id"]) && !empty($productGalleryIds[0])) {
        if ($product_meta["_thumbnail_id"] != $productGalleryIds[0]) {
            set_post_thumbnail($productId, $productGalleryIds[0]);
        }
    }
}

add_action('save_post',  'add_featured_image', 1000);