<?php

namespace App\Http\Tools;

class ClothingTools
{
    public $articles_path = __DIR__ . '/../../../storage/app/public/images/articles/';
    public $base_articles_path = __DIR__ . '/../../../storage/app/public/images/base_articles/';

    /**
     * @var int[]
     */
    public $base_article_shirt_square_bounds = [
        'x' => 204,
        'y' => 340,
        'w' => 340,
        'h' => 450
    ];

    /**
     * @var int[]
     */
    public $article_shirt_square_bounds = [
        'x' => 0,
        'y' => 0,
        'w' => 750,
        'h' => 1000
    ];

    public function __construct()
    {
    }

    public function renderOnClothes($base_article = '', $article = '')
    {
        $origen = imagecreatefromjpeg($this->base_articles_path . $base_article);
        $destino = imagecreatefrompng($this->articles_path . $article);

        if (imagecopyresized(
            $origen,
            $destino,
            $this->base_article_shirt_square_bounds['x'],
            $this->base_article_shirt_square_bounds['y'],
            $this->article_shirt_square_bounds['x'],
            $this->article_shirt_square_bounds['y'],
            $this->base_article_shirt_square_bounds['w'],
            $this->base_article_shirt_square_bounds['h'],
            $this->article_shirt_square_bounds['w'],
            $this->article_shirt_square_bounds['h'])
        ) {
            // Begin capturing the byte stream
            ob_start();

            // generate the byte stream
            imagejpeg($origen, NULL, 100);

            // and finally retrieve the byte stream
            $rawImageBytes = ob_get_clean();

            echo "<img src='data:image/bmp;base64," . base64_encode($rawImageBytes) . "' atl='Camisa'  />";
        } else {

        }
    }
}
