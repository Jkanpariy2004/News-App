<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('fetchArticlesFromApi')) {
    function fetchArticlesFromApi()
    {
        $url = 'https://newsapi.org/v2/everything?q=apple&from=2024-09-02&to=2024-09-02&sortBy=popularity&apiKey=fa5e97426df04f5782bbab982ec48f0b';
        
        try {
            $response = Http::get($url);

            if ($response->successful()) {
                return $response->json()['articles'];
            } else {
                throw new Exception('API call failed: ' . $response->body());
            }
        } catch (\Exception $e) {
            throw new Exception('Error fetching articles: ' . $e->getMessage());
        }
    }
}
