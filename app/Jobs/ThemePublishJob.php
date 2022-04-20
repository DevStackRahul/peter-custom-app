<?php namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use stdClass;
use App\User;
use Illuminate\Support\Facades\File;
class ThemePublishJob implements ShouldQueue
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
        $this->create_snippet($this->shopDomain->toNative() );

        // Do what you wish with the data
        // Access domain name as $this->shopDomain->toNative()
    }

    public function create_snippet($shop) {


         $shop  = User::where('name',$shop)->first();

         $theme_id = $shop->api()->rest('GET','/admin/api/2021-10/themes.json')['body']['themes'];

            if(!empty($shop)) {
        
            for($i=0;$i<count($theme_id);$i++) {
                    
                $main_role   = $theme_id[$i]["role"];
                $main_role_id  = $theme_id[$i]["id"];
                  
                if($main_role =='main') {
                    $active_theme_id  =$main_role_id;
                    $active_theme = $main_role;
                      
                    }
                }

            }

            $get_scripted_file = File::get(storage_path('inject_file/petsidtags_script_added.txt'));

            $data_to_put = [
                
                "asset" => [
                    "key" =>"snippets/petsidtags-added-script.liquid",
                    "value" =>$get_scripted_file
                ]
            ];

           $shop->api()->rest('PUT','/admin/api/2021-10/themes/'.$active_theme_id.'/assets.json',$data_to_put);

           return "200-ok";

    }
}
