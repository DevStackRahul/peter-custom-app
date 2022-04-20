<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignID('user_id')->constrained('users')->onDelete('cascade');
            $table->string('order_id')->nullable(true);
            $table->string('cancel_reason')->nullable(true);
            $table->string('confirmed')->nullable(true);
            $table->string('contact_email')->nullable(true);
            $table->string('current_subtotal_price')->nullable(true);
            $table->string('current_total_discounts')->nullable(true);
            $table->string('current_total_price')->nullable(true);
            $table->string('current_total_tax')->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('order_number')->nullable(true);
            $table->string('processing_method')->nullable(true);
            $table->string('fulfillable_quantity')->nullable(true);
            $table->string('fulfillment_service')->nullable(true);
            $table->string('fulfillment_status')->nullable(true);
            $table->string('line_items_name')->nullable(true);
            $table->string('line_items_origin_location_name')->nullable(true);
            $table->string('line_items_origin_location_address1')->nullable(true);
            $table->string('line_items_origin_location_address2')->nullable(true);
            $table->string('line_items_origin_location_city')->nullable(true);
            $table->string('line_items_origin_location_zip')->nullable(true);


            $table->string('billing_first_name')->nullable(true);
            $table->string('billing_last_name')->nullable(true);
            $table->string('billing_phone')->nullable(true);
            $table->string('billing_address1')->nullable(true);
            $table->string('billing_city')->nullable(true);
            $table->string('billing_province_code')->nullable(true);
            $table->string('billing_zip')->nullable(true);
            $table->string('billing_address_province')->nullable(true);
            $table->string('billing_address_country_code')->nullable(true);
            $table->string('product_id')->nullable(true);
            $table->string('customer_first_name')->nullable(true);
            $table->string('customer_last_name')->nullable(true);
            $table->string('customer_phone_number')->nullable(true);
            $table->string('financial_status')->nullable(true);
            $table->string('delivery_method')->nullable(true);
            $table->string('dog_name_properties')->nullable(true);
            $table->string('phone_number_properties')->nullable(true);
            $table->string('line_text_1')->nullable(true);
            $table->string('line_text_2')->nullable(true);
            $table->string('total_quantity')->nullable(true);
            $table->string('sku')->nullable(true);
            $table->string('shipping_first_name')->nullable(true);
            $table->string('shipping_last_name')->nullable(true);
            $table->string('shipping_address_name')->nullable(true);
            $table->string('shipping_city')->nullable(true);
            $table->string('shipping_country')->nullable(true);
            $table->string('shipping_province_state')->nullable(true);
            $table->string('shipping_province_code')->nullable(true);
            $table->string('shipping_zip')->nullable(true);
            $table->string('shipping_country_code')->nullable(true);
            $table->string('reddingo_tag')->nullable(true);
            $table->string('created_at')->nullable(true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
