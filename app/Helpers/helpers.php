<?php 

if (! function_exists('formatPrice')) {
    /**
     * 
     * format price
     */

     function formatPrice($str) {
        return 'Rp. ' . number_format($str, '0', '', '.');
     }
}