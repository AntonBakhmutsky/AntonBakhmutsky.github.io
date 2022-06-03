<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Image Driver
  |--------------------------------------------------------------------------
  |
  | Intervention Image supports "GD Library" and "Imagick" to process images
  | internally. You may choose one of them according to your PHP
  | configuration. By default PHP's "GD Library" implementation is used.
  |
  | Supported: "gd", "imagick"
  |
  */

  'driver' => env('THUMBNAILS_IMAGE_DRIVER', 'gd'),
  'cache' => [
    'directory' => env('THUMBNAILS_CACHE_DIRECTORY', 'storage/cached'),
    'ttl' => env('THUMBNAILS_CACHE_TTL', 86400),
    'key' => 'thumbnails'
  ]

];
