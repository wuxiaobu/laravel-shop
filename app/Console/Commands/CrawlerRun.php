<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use XCrawler\XCrawler;
use Symfony\Component\DomCrawler\Crawler;

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
        'name' => 'dytt8:detail',
        'concurrency' => 100,
        'requests' => function() {
            for($i=1; $i<=10; $i++){
              $url = "http://b2b.huangye88.com/guangdong/jixie/pn{$i}/";
              yield $url;
            }
        },
        'success' => function($result, $request, $xcrawler) {
          //$result = iconv('GBK', 'UTF-8', $result);
          $crawler = new Crawler();
          $crawler->addHtmlContent($result);

          $crawler->filter('h4')->each(function (Crawler $node, $i) use (&$data) {
              $data[] = $node->html();
          });
          var_dump($data);
        }
      ]);
      
      $result = $xcrawler->run();
    } 

}
