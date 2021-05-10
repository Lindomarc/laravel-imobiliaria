<?php


    namespace App\Support;


    use CoffeeCode\Optimizer\Optimizer;

    class Seo
    {
        private $optimizer;

        public function __construct()
        {
            $this->optimizer = new Optimizer();
            $this->optimizer->openGraph(
                getenv('APP_NAME')
            )->twitterCard(
                getenv('CLIENT_SOCIAL_TWITTER_CREATOR'),
                getenv('CLIENT_SOCIAL_TWITTER_PUBLISHER'),
                getenv('APP_URL')
            )->publisher(
                getenv('CLIENT_SOCIAL_FACEBOOK_PAGE'),
                getenv('CLIENT_SOCIAL_FACEBOOK_AUTHOR')
            )->facebook(
                getenv('CLIENT_SOCIAL_FACEBOOK_APP')
            );
        }

        public function render(
            string $title,
            string $description,
            string $url,
            string $image,
            bool $follow = true
        )
        {
            return $this->optimizer->optimize(
                $title,
                $description,
                $url,
                $image,
                $follow
            )->render();
        }
    }
