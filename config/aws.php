<?php

return [
  'access_key_id' => env('AWS_ACCESS_KEY_ID'),
  'secret_access_key' => env('AWS_SECRET_ACCESS_KEY'),
  'default_region' => env('AWS_DEFAULT_REGION'),
  'default_version' => env('AWS_DEFAULT_VERSION'),
  'bucket_name' => env('AWS_BUCKET'),
  'cognito' => [
    'user_pool_id' => env('AWS_COGNITO_USER_POOL_ID'),
  ],
];
