<?php namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use stdClass;
use App\User;
use App\Order;
use DB;

class OrdersCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain|string
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain.
     * @param stdClass $data       The webhook data (JSON decoded).
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Convert domain
        $this->shopDomain = ShopDomain::fromNative($this->shopDomain);
            $this->create_order($this->shopDomain->toNative() );

        // Do what you wish with the data
        // Access domain name as $this->shopDomain->toNative()
    }


     public function create_order($shop) {

        header('Access-Control-Allow-Origin: *');
        $shop  = User::where('name',$shop)->first();

        $user_id =   $shop->id;

        $webhook_order_id  =  file_get_contents('php://input');
        $get_order_data  =  json_decode($webhook_order_id,true);
        
        //info($get_order_data);

         for($i=0;$i<count($get_order_data["line_items"]);$i++) {

       
        // info($check_reddingo);

         // check properties

            if(!empty($get_order_data['line_items'][$i]['properties'])) {

         // end
        if(isset($get_order_data['line_items'][$i]['properties'][0]['value'])) {

           if($get_order_data['line_items'][$i]['properties'][0]['value'] == 'reddingo') {


        /*
         * LOOP GOES HERE 
         *
        */

        $reddingo_tag   = $get_order_data['line_items'][$i]['properties'][0]['value'];

        $order_id = $get_order_data['id'];
      
        $cancel_reason = $get_order_data['cancel_reason'];

        $confirmed = $get_order_data['confirmed'];
        $contact_email = $get_order_data['contact_email'];


        $current_subtotal_price = $get_order_data['current_subtotal_price'];

        $current_total_discounts = $get_order_data['current_total_discounts'];
        $current_total_price = $get_order_data['current_total_price'];


        $current_total_tax = $get_order_data['current_total_tax'];
        $name = $get_order_data['name'];


        $processing_method = $get_order_data['processing_method'];

        $fulfillable_quantity = $get_order_data['line_items'][$i]['fulfillable_quantity'];
        $fulfillment_service =  $get_order_data['line_items'][$i]['fulfillment_service'];
        $fulfillment_status =  $get_order_data['line_items'][$i]['fulfillment_status'];
        $line_items_name  =  $get_order_data['line_items'][$i]['origin_location']['name'];

        $line_items_origin_location_address1 = $get_order_data['line_items'][$i]['origin_location']['address1'];
       // $line_items_origin_location_address2 = $get_order_data['line_items'][0]['origin_location']['address2'];

        $line_items_origin_location_city = $get_order_data['line_items'][$i]['origin_location']['city'];
        $line_items_origin_location_zip = $get_order_data['line_items'][$i]['origin_location']['zip'];

        // billing address//

         $billing_first_name = $get_order_data['billing_address']['first_name'];
         $billing_last_name = $get_order_data['billing_address']['last_name'];

         $billing_phone = $get_order_data['customer']['default_address']['phone'];
         
         $billing_address1 = $get_order_data['billing_address']['address1'];
         $billing_city = $get_order_data['billing_address']['city'];
         $billing_province_code = $get_order_data['billing_address']['province_code'];
         $billing_zip = $get_order_data['billing_address']['zip'];


         $billing_address_province = $get_order_data['billing_address']['province'];
         $billing_address_country_code = $get_order_data['billing_address']['country_code'];


        // End  billing addres


        $line_items_origin_product_id = $get_order_data['line_items'][$i]['product_id'];

        //  $line_items_origin_country_code = $get_order_data['line_items'][0]['origin_location']['country_code'];
        


        $order_number = $get_order_data['order_number'];
    
        $customer_first_name = $get_order_data['customer']['first_name'];
        $customer_last_name = $get_order_data['customer']['last_name'];

        $customer_phone_number = $get_order_data['customer']['phone'];
        
        $financial_status = $get_order_data['financial_status'];
        
        $delivery_method = $get_order_data['shipping_lines'][0]['code'];


        /*
         * Add engraving field in database
         *
        */ 

       // $dog_name_properties  = $get_order_data['line_items'][0]['properties'][1]['value'];

        /*
         *
         *
        */

        if(isset($get_order_data['line_items'][$i]['properties'][1]['value'])) {

                $dog_name_properties=$get_order_data['line_items'][$i]['properties'][1]['value'];

        } else {

                $dog_name_properties='';

        }

        /*
         *
         * end dog properties 
        */




        /*
         * Add phone number properties
         *
        */

        // $phone_number_properties  = $get_order_data['line_items'][0]['properties'][2]['value'];

        if(isset($get_order_data['line_items'][$i]['properties'][2]['value'])) {

                $phone_number_properties  =  $get_order_data['line_items'][$i]['properties'][2]['value'];

        } else {

                $phone_number_properties ='';
        }

        /*
         * End
         *
        */

        /*
         * Add line 1 properties
         *
        */



        //$line_text_1  = $get_order_data['line_items'][0]['properties'][3]['value'];
       

        if(isset($get_order_data['line_items'][$i]['properties'][3]['value'])) {


                $line_text_1   =  $get_order_data['line_items'][$i]['properties'][3]['value'];

        } else {


                $line_text_1 ='';
        }


         /*
         *  end 
         *
        */


      //  $line_text_2  = $get_order_data['line_items'][0]['properties'][4]['value'];
    

        if(isset($get_order_data['line_items'][$i]['properties'][4]['value'])) {

                $line_text_2 = $get_order_data['line_items'][$i]['properties'][4]['value'];;

        } else {

            $line_text_2 = '';

        }

        // end engraving line 

        $total_quantity  = $get_order_data['line_items'][$i]['quantity'];

        $sku  = $get_order_data['line_items'][$i]['sku'];

        $shipping_first_name = $get_order_data['shipping_address']['first_name'];
        $shipping_last_name = $get_order_data['shipping_address']['last_name'];
        $shipping_address_name = $get_order_data['shipping_address']['address1'];

        //new add 

        $shipping_city = $get_order_data['shipping_address']['city'];
        $shipping_country = $get_order_data['shipping_address']['country'];
        $shipping_province_state = $get_order_data['shipping_address']['province'];
        $shipping_province_code = $get_order_data['shipping_address']['province_code'];
        $shipping_zip = $get_order_data['shipping_address']['zip'];
        $shipping_country_code = $get_order_data['shipping_address']['country_code'];

        // End 
    
        /*
         * end 
         *
        */

        $created_at = date('Y-m-d');

$values = array('user_id' => $user_id,'order_id' => $order_id,'cancel_reason'=>$cancel_reason,'confirmed'=>$confirmed,'contact_email'=>$contact_email,'current_subtotal_price'=>$current_subtotal_price,'current_total_discounts'=>$current_total_discounts,'current_total_price'=>$current_total_price,'current_total_tax'=>$current_total_tax,'name'=>$name,'processing_method'=>$processing_method,'fulfillable_quantity'=>$fulfillable_quantity,'fulfillment_service'=>$fulfillment_service,'fulfillment_status'=>$fulfillment_status,'line_items_name'=>$line_items_name,'line_items_origin_location_address1'=>$line_items_origin_location_address1,'line_items_origin_location_address2'=>$shipping_address_name,'line_items_origin_location_city'=>$line_items_origin_location_city,'line_items_origin_location_zip'=>$line_items_origin_location_zip,'billing_first_name'=>$billing_first_name,'billing_last_name'=>$billing_last_name,'billing_phone'=>$billing_phone,'billing_address1'=>$billing_address1,'billing_city'=>$billing_city,'billing_province_code'=>$billing_province_code,'billing_zip'=>$billing_zip,'billing_address_province'=>$billing_address_province,'billing_address_country_code'=>$billing_address_country_code,'product_id'=>$line_items_origin_product_id,'order_number'=>$order_number,'customer_first_name'=>$customer_first_name,'customer_last_name'=>$customer_last_name,'customer_phone_number'=>$customer_phone_number,'financial_status'=>$financial_status,'delivery_method'=>$delivery_method,'dog_name_properties'=>$dog_name_properties,'phone_number_properties'=>$phone_number_properties,'line_text_1'=> $line_text_1,'line_text_2'=>$line_text_2,'total_quantity'=>$total_quantity,'sku'=>$sku,'shipping_first_name'=>$shipping_first_name,'shipping_last_name'=>$shipping_last_name,'shipping_address_name'=>$shipping_address_name,'shipping_city'=>$shipping_city,'shipping_country'=>$shipping_country,'shipping_province_state'=>$shipping_province_state,'shipping_province_code'=>$shipping_province_code,'shipping_zip'=>$shipping_zip,'shipping_country_code'=>$shipping_country_code,'reddingo_tag'=>$reddingo_tag,'created_at'=>$created_at);

        $test = DB::table('orders')->insert($values);

        //info($test);

        /*
         * POST /tags.reddingo.com api 
         * 
        */

         // info($line_text_1);
         // info($line_text_2);


        
        $url = "https://tags.reddingo.com/api/stores/submit/";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
            "Content-Type: application/json",
            'Authorization: Basic '. base64_encode("cZMTkCDVRLRMTiVbBFBPFkj5PsVU8mgjdsgPkA6qzivgLUUur6:nHZfjrJfkLakAvZnvpVhGkr5KiYPmYiEzPCp9iXqXbxFMtgjct")
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


            $post_field_array =  array(
                "AUDTORG"=>"REDAUS",
                "IDCUST"=>"DOGNATIONAU",
                "ownerFirstName" =>$billing_first_name,
                "ownerLastName"=>$billing_last_name,
                "petName"=>"", 
                "ownerPhone"=>$billing_phone,
                "ownerEmail"=>$contact_email,
                "ownerAddress"=>$billing_address1,
                "ownerSuburbTownCity"=>$billing_city,
                "ownerStateProvinceRegion"=>$billing_address_province,
                "ownerPostZipCode"=>$billing_zip,
                "ownerCountryCode"=>$billing_address_country_code,
                "receiver"=>$shipping_first_name.' '.$shipping_last_name,
                "receiverAddress"=>$shipping_address_name,
                "receiverSuburbTownCity"=>$shipping_city,   
                "receiverStateProvinceRegion"=>$shipping_province_state,
                "receiverPostZipCode"=>$shipping_zip,
                "receiverCountryCode"=>$shipping_country_code,
                "customerMessage"=>"",
                "quantity"=>$total_quantity,
                "tag"=>$sku,
                "font"=>"engrave",
                "doubleSided"=>false,
                "noEngraving"=>false,
                "engravingLines"=> [$dog_name_properties,$phone_number_properties,$line_text_1,$line_text_2],  //[$line_text_1,$line_text_2],
                "engravingLines2"=>[], //[$dog_name_properties,$phone_number_properties],
                "sendToStore"=>false,
                "reference"=>"",
                "emailStatusUpdates"=>false,
                "draft"=>false,
                //"order" => $order_id

            );

            $reddingo_post_json_data = json_encode($post_field_array);  

            curl_setopt($curl, CURLOPT_POSTFIELDS, $reddingo_post_json_data);

            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

              curl_exec($curl);

         
             
             //return header("HTTP/1.1 200 OK");  
         
             // info($resp);
              
              //return true;
        /*
         * End /tags.reddingo.com api 
         * 
        */



         /*
         * LOOP END HERE
         *
        */

         } else {
            
            continue;
        }
        

            }  else   {

                return header("HTTP/1.1 200 OK");
           // info('exit');
           // return false;
         }

       } else {

            continue;
          }

        }
        return header("HTTP/1.1 200 OK");   

     }
}
