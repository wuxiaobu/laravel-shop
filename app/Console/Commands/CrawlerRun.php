<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use XCrawler\XCrawler;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Instagram;

class CrawlerRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'just a crawler';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    { 
      $xcrawler = new XCrawler([
        'name' => 'huangye:detail',
        'concurrency' => 3,
        'timeout' => 5,   
        'interval' => 0.1, 
/*        'requests' => function() {
          $base_url = "https://www.instagram.com/";
          for ($i=1; $i <= 1; $i++) {
              $request = [
                  'method' => 'get',
                  'uri' => $base_url.'austin_993/',

                  //'proxy' => 'http://111.177.182.25:9999',
                  'headers' => [
                      'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36',
                      'Cookie' => 'mid=W8bTFAALAAEvj_-SxRU4xGd35CfI; mcd=3; fbm_124024574287414=base_domain=.instagram.com; ds_user_id=7181311508; csrftoken=LqP5ZofrLRHeveeZInxWv1wFrvu2mw9t; sessionid=7181311508%3AOLOmjBQQnGKJAc%3A1; shbid=10555; rur=PRN; shbts=1548210868.830127; urlgen="{\"121.7.45.129\": 9506}:1gmCsl:-FRsfzAe_oB1RZKQ4dLj_hMCYt0',
                    ],
              ];
              yield $request;
          }
        },*/
        'requests' => function() {
            if ($csvFileHandler = fopen(public_path('1.csv'), 'r')) { 
                $columns = fgetcsv($csvFileHandler, 0, ",");
                while (($rowData = fgetcsv($csvFileHandler, 0, ",")) !== false) {
                    $url = $rowData[17]??'';
                    if($url){
                        $request = [
                            'uri' => $url,
                            'headers' => [
                                'referer' => 'https://www.instagram.com/amyr_aminu/',
                                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36',
                                'Cookie' => 'mid=W8bTFAALAAEvj_-SxRU4xGd35CfI; mcd=3; fbm_124024574287414=base_domain=.instagram.com; ds_user_id=7181311508; csrftoken=LqP5ZofrLRHeveeZInxWv1wFrvu2mw9t; sessionid=7181311508%3AOLOmjBQQnGKJAc%3A1; shbid=10555; rur=PRN; shbts=1548210868.830127; urlgen="{\"121.7.45.129\": 9506}:1gmbu7:DWnhAfxSMUwDUnTQToRMRo2J2zY',
                            ],
                        ];
                        yield $request;
                    }
                }
            }    
        },
        'success' => function($result, $request, $xcrawler, $resHeaders) {
          
          //$result = iconv('GBK', 'UTF-8', $result);
      /*    $crawler = new Crawler();
          $crawler->addHtmlContent($result);

          $crawler->filter('h4')->each(function (Crawler $node, $i) use (&$data) {
              $data[] = $node->html();
          });*/
            //var_dump(str_limit($result, 100, '.........'));
            try{
                $content = (explode('window._sharedData = ', $result))[1];
                $content = (explode(';</script>', $content))[0];
                $content = json_decode($content, true);
                
                $data = $content['entry_data']['ProfilePage'][0]['graphql']['user'];
                $userInfo['nickname'] = $data['full_name']??'';
                $userInfo['username'] = $data['username']??'';
                $userInfo['biography'] = $data['biography']??'';
                $userInfo['business_category_name'] = $data['business_category_name']??'';
                $userInfo['email'] = $data['business_email']??''; 
                $userInfo['phone'] = $data['business_phone_number']??''; 
                $userInfo['followers'] = $data['edge_followed_by']['count']??'';
                $userInfo['avatar'] = $data['profile_pic_url_hd']??'';
                $userInfo['country'] = '';
                if($data['business_address_json']){
                    $address = json_decode($data['business_address_json'], true);
                    $userInfo['country'] = strtolower($address['country_code']);
                }
               
                /*$file = fopen(public_path('3.csv'),"a+");
                if (flock($file,LOCK_EX)){
                    fputcsv($file,$userInfo);
                    flock($file,LOCK_UN); 
                }
                fclose($file);*/
                Instagram::insert($userInfo);
            }
            catch(\Expection $e){
                \Log::info($e->getMessage());
            }    
        }
      ]);
      
      $result = $xcrawler->run();
    } 

}
