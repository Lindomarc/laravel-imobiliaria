<?php


	namespace App\Support;


	class Cropper
	{
	    public static function thumb(string $uri, int $width, int $height = null)
        {
            $cropper = new \CoffeeCode\Cropper\Cropper('../public/storage/cache');
            $pathThumb = $cropper->make(
                config('filesystems.disks.public.root').'/'.$uri,
                $width,
                $height
            );
            return 'cache/'.collect(explode('/',$pathThumb))->last();;
        }

        public static  function flush(?string $path)
        {
            $cropper = new \CoffeeCode\Cropper\Cropper('../public/storage/cache');
            if (!$path) {
                $cropper->flush($path);
            } else {
                $cropper->flush();
            }
        }

	}
