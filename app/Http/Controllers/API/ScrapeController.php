<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;


use App\Models\Product;
class ScrapeController extends Controller
{
    
    public function scrape()
    {
        $options = [
            'timeout' => 10,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3',
            ],
            'verify_peer' => false,
        ];
        
        $client = new HttpBrowser(new NativeHttpClient($options));

        $crawler = $client->request('GET', 'https://sugargang.com/collections/alle-produkte');

        $last_page = intval($crawler->filter('.pagination .pagination__inner .pagination__nav a.pagination__nav-item')->last()->text());

        $products = collect([]);

        for ($i=1; $i <= $last_page; $i++) { 
            $crawler = $client->request('GET', 'https://sugargang.com/collections/alle-produkte?page='.$i);

            $crawler->filter('.product-item')->each(function (Crawler $node, $i) use($products) {
            
                $products->push([
                    'product_img' => $node->filter('.product-item__image-wrapper .aspect-ratio img')->last()->attr('src'),
                    'product_name' => $node->filter('.product-item__info .product-item__info-inner a')->text(),
                    'price' => trim(str_replace('Sonderpreis', '', $node->filter('.product-item__info .product-item__info-inner .product-item__price-list .price')->first()->text())),
                    'product_ingredients' => $node->filter('.product-item__info .product-item__info-inner .product-item__price-info')->filter('span')->each(function(Crawler $node, $i) {
                        return $node->text();
                    })
                ]);
            });
        }

        $this->addCollectionToDatabase($products);

        return response()->json(['message' => 'Successfully inserted in database'], 200);
    }

    function addCollectionToDatabase($products)
    {

        Product::truncate();

        foreach ($products as $key => $value) {

            Product::create([
                'product_img' => $value['product_img'],
                'product_name' => $value['product_name'],
                'price' => $value['price'],
                'product_ingredients' => Arr::join($value['product_ingredients'], ' '),
                'quantity' => 0,
                'sku' => ''
            ]);
        }
    }
}
