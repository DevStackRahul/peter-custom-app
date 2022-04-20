<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login',function(){
    return view('login');
})->name('login');

Route::get('/', function () {



        $check_shop_user  =  auth()->user();

       // $theme_id = $check_shop_user->api()->rest('GET','/admin/api/2021-10/webhooks.json');
       //  echo "<pre>";
       //  print_r($theme_id);
       //  die;
            
        $check_script_added = User::where('name',$check_shop_user->name)->first();


        if(empty($check_script_added->script_added_text )) {

            User::where('name',$check_shop_user->name)->update([
                'script_added_text' =>0,

        ]);

    
        /*
         * Added the script 
         *
        */

        $theme_id = $check_shop_user->api()->rest('GET','/admin/api/2021-10/themes.json')['body']['themes'];
        //print_r($theme_id);


        for($i=0;$i<count($theme_id);$i++) {
                    
                $main_role   = $theme_id[$i]["role"];
                $main_role_id  = $theme_id[$i]["id"];
                  
                if($main_role =='main') {
                    $active_theme_id  =$main_role_id;
                    $active_theme = $main_role;
                      
                    }
            }
        

            $get_scripted_file = File::get(storage_path('inject_file/petsidtags_script_added.txt'));

            $data_to_put = [
                
                "asset" => [
                    "key" =>"snippets/petsidtags-added-script.liquid",
                    "value" =>$get_scripted_file
                ]
            ];

            $check_shop_user->api()->rest('PUT','/admin/api/2021-10/themes/'.$active_theme_id.'/assets.json',$data_to_put);


        /*
         * Ended the script 
         *
        */


     } else if($check_script_added->script_added_text==1) {


        User::where('name',$check_shop_user->name)->update([
            'script_added_text' =>0,

        ]);

        /*
         * Added the script 
         *
        */

        $theme_id = $check_shop_user->api()->rest('GET','/admin/api/2021-10/themes.json')['body']['themes'];
        //print_r($theme_id);


        for($i=0;$i<count($theme_id);$i++) {
                    
                $main_role   = $theme_id[$i]["role"];
                $main_role_id  = $theme_id[$i]["id"];
                  
                if($main_role =='main') {
                    $active_theme_id  =$main_role_id;
                    $active_theme = $main_role;
                      
                    }
            }
        

            $get_scripted_file = File::get(storage_path('inject_file/petsidtags_script_added.txt'));

            $data_to_put = [
                
                "asset" => [
                    "key" =>"snippets/petsidtags-added-script.liquid",
                    "value" =>$get_scripted_file
                ]
            ];

            $check_shop_user->api()->rest('PUT','/admin/api/2021-10/themes/'.$active_theme_id.'/assets.json',$data_to_put);

     }




        // $url = "https://e11789c6eaac695d38379503098a972a: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@thousand-solutions-dev.myshopify.com/admin/api/2022-01/themes/114897289394/assets.json?asset[key]=snippets/petsidtags-added-script.liquid";
        //     $curl = curl_init();
        //     curl_setopt($curl, CURLOPT_URL, $url);
        //     curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($curl, CURLOPT_VERBOSE, 0);
        //     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        //     //curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($created_bundle));
        //     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //     $response = curl_exec ($curl);
        //     curl_close ($curl);

        //     $obj = json_decode($response);

        //     echo "<pre>";
        //     print_r($obj);
        //     die;



             //// https://thousand-solutions-dev.myshopify.com/admin/themes/114897289394?key=snippets/petsidtags-added-script.liquid

            // $Delete_script_file =  $check_shop_user->api()->rest('GET','/admin/api/2022-01/themes/114897289394/assets.json?asset[key]=templates/index.liquid');

            // echo "<pre>";
            // print_r($Delete_script_file);
            // die; 

             // $theme_id = $check_shop_user->api()->rest('GET','/admin/api/2022-01/webhooks.json');
             // echo "<pre>";
             // print_r($theme_id);
             // die;
            
    
    $get_order = Order::select("*")
                        ->where('user_id',$check_shop_user->id)
                        ->get();
    return view('welcome',['orderData'=>$get_order]);
})->middleware(['verify.shopify'])->name('home');



Route::get('/test', 'UserController@index')->middleware(['verify.shopify'])->name('test');

Route::post('/email-sent', 'UserController@email_sent')->name('email-sent');


Route::post('/sent-order', 'UserController@sent_order')->middleware(['verify.shopify'])->name('sent-order');

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);




