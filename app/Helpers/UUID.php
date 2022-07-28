<?php

namespace App\Helpers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class UUID
{
    static function generate()
    {
        $uuid = substr((string) Str::uuid(), 0, 8);
        return $uuid;
    }

    static function ProductCode()
    {
        $prefix = 'P';
        $flag = true;
        $start = 'P000001';
        $result = '';
        while ($flag) {
            $exist_code = Product::where('product_code', $start)->first();
            if (!$exist_code) {
                $result = $start;
                $flag = false;
            }
            $code_without_prefix = substr($start, 1);
            $code_without_zero = ltrim($code_without_prefix, "0");
            $code_increase_one = str_pad($code_without_zero + 1, 6, "0", STR_PAD_LEFT);
            $start = $prefix . $code_increase_one;
        }
        return $result;
    }
    static function CategoryCode()
    {
        $prefix = 'C';
        $flag = true;
        $start = 'C000001';
        $result = '';
        while ($flag) {
            $exist_code = Category::where('category_code', $start)->first();
            if (!$exist_code) {
                $result = $start;
                $flag = false;
            }
            $code_without_prefix = substr($start, 1);
            $code_without_zero = ltrim($code_without_prefix, "0");
            $code_increase_one = str_pad($code_without_zero + 1, 6, "0", STR_PAD_LEFT);
            $start = $prefix . $code_increase_one;
        }
        return $result;
    }
    static function BrandCode()
    {
        $prefix = 'B';
        $flag = true;
        $start = 'B000001';
        $result = '';
        while ($flag) {
            $exist_code = Brand::where('brand_code', $start)->first();
            if (!$exist_code) {
                $result = $start;
                $flag = false;
            }
            $code_without_prefix = substr($start, 1);
            $code_without_zero = ltrim($code_without_prefix, "0");
            $code_increase_one = str_pad($code_without_zero + 1, 6, "0", STR_PAD_LEFT);
            $start = $prefix . $code_increase_one;
        }
        return $result;
    }
    // static function OrderCode()
    // {
    //     $prefix = 'D';
    //     $flag = true;
    //     $start = 'D000001';
    //     $result = '';
    //     while ($flag) {
    //         $exist_code = Order::where('order_code', $start)->first();
    //         if (!$exist_code) {
    //             $result = $start;
    //             $flag = false;
    //         }
    //         $code_without_prefix = substr($start, 1);
    //         $code_without_zero = ltrim($code_without_prefix, "0");
    //         $code_increase_one = str_pad($code_without_zero + 1, 6, "0", STR_PAD_LEFT);
    //         $start = $prefix . $code_increase_one;
    //     }
    //     return $result;
    // }
}