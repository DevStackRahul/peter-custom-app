<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use stdClass;
use App\User;


class AppUninstalledJob  implements ShouldQueue
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
        
        
        $this->app_uninstalled_job($this->shopDomain->toNative() );

    }

     public function app_uninstalled_job($shop) {



		try {

            $shop = User::where('name',$shop)->first();

            User::where('name',$shop->name)->update([
                'script_added_text' =>1,

            ]);

            $shop->delete();


            /*
			 * remove snippet code from the current theme
			 *
			*/

            //$theme_id = $shop->api()->rest('GET','/admin/api/2021-10/themes.json')['body']['themes'];

			// for($i=0;$i<count($theme_id);$i++) {
                    
            // $main_role   = $theme_id[$i]["role"];
            // $main_role_id  = $theme_id[$i]["id"];
                  
            //  if($main_role =='main') {
                    	
            // 	$active_theme_id  =$main_role_id;
            // 	$active_theme = $main_role;
                      
            // }
            // }

            		
            //  $Delete_script_file =  $shop->api()->rest('DELETE','/admin/api/2021-10/themes/'.$active_theme_id.'/assets.json',['asset[key]'=>'snippets/petsidtags_script_added.liquid']);

            //    info($Delete_script_file);


            /*
			 * END remove snippet code from the current theme
			 *
			*/


            return;
        }
        
        catch(\Exception $e) {
            Log::error($e->getMessage());
        }



    }


}
