<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class UserController extends Controller
{

    /*
    * call the toggle functionality when enalbed or
    *  disabled
    */
   public function index(Request $request) {


            $url = "https://e11789c6eaac695d38379503098a972a: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@petsidtags-x.myshopify.com/admin/api/2021-10/orders/4708238196973.json";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_VERBOSE, 0);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
           // curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($created_bundle));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec ($curl);
            curl_close ($curl);


            $get_order_data  =  json_decode($response, JSON_PRETTY_PRINT)['order'];

          //   $dog_name_properties  = $get_order_data['line_items'][0]['properties'][1]['value'];
            // echo "<pre>";
            // print_r(count($get_order_data["line_items"]));

            for($i=0;$i<count($get_order_data["line_items"]);$i++){

                
                if($get_order_data['line_items'][$i]['properties'][0]['value']=='reddingo')  {

                    if(isset($get_order_data['line_items'][$i]['properties'][1]['value'])) {


                         $line1    =   $get_order_data['line_items'][$i]['properties'][1]['value'];
                          echo $line1;

                    }  else {

                         $line1  ='yes exist';
                        echo $line1;

                    }
                } else {

                    exit;
                }

            }
            die;
           // print_r($dog_name_properties.'testdfdf');
            die;


                    // $curl = curl_init();

                    // curl_setopt_array($curl, array(
                    // CURLOPT_URL => 'https://tags.reddingo.com/testing/api/stores/tags/',
                    // CURLOPT_RETURNTRANSFER => true,
                    // CURLOPT_ENCODING => '',
                    // CURLOPT_MAXREDIRS => 10,
                    // CURLOPT_TIMEOUT => 0,
                    // CURLOPT_FOLLOWLOCATION => true,
                    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    // CURLOPT_CUSTOMREQUEST => 'GET',
                    // CURLOPT_HTTPHEADER => array(
                    // 'Authorization: Basic WGczZ1BtaEhraU1oMjIlUG9CYk5Uczg9K3NZOCtrWFh3bywlLUVKenBpSEVAeVpDVm86XWlBM0tNVT1DRndrLCMsYl44ckRmOTcjSC5STUBqQnlLfS4uTXdLZ1hwRTg4QFY+QF0='
                    // ),
                    // ));

                    // $response = curl_exec($curl);

                    // $array = json_decode( $response, true );

                    //  curl_close($curl);
                    
                    // // echo "<pre>";
                    // // print_r($array);
                    // // die;
                    //     $date_array = '';
                    //     foreach($array  as $result) {

                                 
                    //           if($result['colour'] == 'Dark Blue') {
                                    
                    //                 $date_array = $result['colourCode'];

                               
                    //             }
                        
                    //           }

                    //     echo "<pre>";

                    //     print_r($date_array);


                       // die;


       
       // $shop =  auth()->user();
       // $theme_id = $shop->api()->rest('GET','/admin/api/2022-01/orders/4366281638065.json');
       
       // echo "<pre>";
       
       // print_r($theme_id);
       // die;
    }

    public function  email_sent(Request $request) {

            $email_address = $request->input('email_address');
            $name = $request->input('name');
            $subject = $request->input('subject');
            $message = $request->input('message');


            $details = [
                'title' => $subject,
                'body' => $message
            ];

            \Mail::to($email_address)->send(new \App\Mail\PetsidtagsEmail($details));

            return 1;




    }

     public function  sent_order(Request $request) {

            
        $initial_order_number = $request->input('initial_order_number');
        $last_order_number = $request->input('last_order_number');
        
        $shop =auth()->user();

        $created_at = date("Y-m-d");


        $order_setInsertDB = array(
            'user_id' =>$shop->id,
            'initial_order_range'=>$initial_order_number,
            'last_order_range'=>$last_order_number,
            'created_at' =>$created_at

        );
        $insert_order = DB::table('order_range')->insert($order_setInsertDB);

        if($insert_order=true) {

            return 1;
        } else {

            return 0;
        }


   

    }

}
