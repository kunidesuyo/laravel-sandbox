<?php

namespace App\Services;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

class AwsService {

  public $S3Client;

  function __construct()
  {
    $this->S3Client = new S3Client([
      'region' => 'ap-northeast-1',
      'version' => '2006-03-01',
      'credentials' => [
        'key' => config('filesystems.disks.s3.key'),
        'secret' => config('filesystems.disks.s3.secret'),
      ],
    ]);
  }

  public function listObjects() {
    return $this->S3Client->listObjects([
      'Bucket' => config('filesystems.disks.s3.bucket'),
    ]);
  }
}