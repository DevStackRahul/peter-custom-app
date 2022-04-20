<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
   
    protected $fillable = [
        'id','user_id','cancel_reason','confirmed','contact_email','current_subtotal_price','current_total_discounts','current_total_price','current_total_tax','name','order_number','processing_method','fulfillable_quantity','fulfillment_service','fulfillment_status','line_items_name','line_items_origin_location_name','line_items_origin_location_address1','line_items_origin_location_address2','line_items_origin_location_city','line_items_origin_location_zip','product_id',
    ];
}
