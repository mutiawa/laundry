<?php

namespace App\Http\Controllers;

// untuk mengakses http
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // untuk tes response dari API
    public function index()
    {
        $response = Http::get('https://newsapi.org/v2/everything?q=laundry=2024-04-25&sortBy=publishedAt&apiKey=41a17e98746f46c8a0d4ebfa4c2c1739');
        $hasil = json_decode($response);
        // var_dump($hasil);

        if ($hasil->status == "ok") {
            echo "Jumlah Status     : " . $hasil->status . "<br>";
            echo "Jumlah Results    : " . $hasil->totalResults . "<br>";
            echo "Sumber Artikel-1  : " . $hasil->articles[0]->source->name . "<br>";
            echo "Nama Artikel-2    : " . $hasil->articles[1]->title . "<br>";
            echo "URL Gambar        : " . $hasil->articles[1]->urlToImage . "<br>";

            // dapatkan jumlah datanya
            echo "<hr>";
            foreach ($hasil->articles as $row) {
                echo $row->source->name . "-" . $row->author . "-" . $row->title . "-" . $row->url . "-" . $row->description . "-" . $row->urlToImage;
                echo "<br>";
            }

        }
    }

    // untuk galeri berita
    public function getNews1()
    {
        // akses API
        $url = 'https://newsapi.org/v2/everything?q=laundry=2024-04-25&sortBy=publishedAt&apiKey=41a17e98746f46c8a0d4ebfa4c2c1739';
        $response = Http::get($url);
        $hasil = json_decode($response);
        // var_dump($hasil);
        return view(
            'berita.berita',
            [
                'hasil' => $hasil
            ]
        );
    }

    // untuk galeri berita
    public function getNews2()
    {
        // akses API
        $url = 'https://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=60a1089e92224b418b29be83e175cf5a';
        $response = Http::get($url);
        $hasil = json_decode($response);
        // var_dump($hasil);
        return view(
            'berita.berita',
            [
                'hasil' => $hasil
            ]
        );
    }
}
