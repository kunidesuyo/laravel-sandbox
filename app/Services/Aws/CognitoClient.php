<?php

namespace App\Services\Aws;

// SDKの中から使うクラス
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;

class CognitoClient
{
    protected CognitoIdentityProviderClient $client;
    protected $clientId;
    protected $poolId;

    public function __construct()
    {
      $this->client = new CognitoIdentityProviderClient([
        'region' => config('aws.default_region'),
        'version' => config('aws.default_version'),
        'credentials' => [
          'key' => config('aws.access_key_id'),
          'secret' => config('aws.secret_access_key'),
        ],
      ]);
    }

    public function listUsers()
    {
      $users = $this->client->listUsers([
        'UserPoolId' => config('aws.cognito.user_pool_id'),
      ]);
      var_dump($users);
    }

    public function signUp($email, $password) {
      try {
          //CognitoIdentityProviderClientクラスのsignUpメソッド
          $this->client->signUp([
              'ClientId' => $this->clientId,
              'Password' => $password,
              // 'UserAttributes' => $username,
              'Username' => $email,
          ]);

      } catch (CognitoIdentityProviderException $e) {
          throw $e;
      }  
    }



    // public function register($username, $email, $password)
    // {
    //     $attributes['email'] = $email;

    //     try {
    //         //CognitoIdentityProviderClientクラスのsignUpメソッド
    //         $this->client->signUp([
    //             'ClientId' => $this->clientId,
    //             'Password' => $password,
    //             // 'UserAttributes' => $username,
    //             'Username' => $email,
    //         ]);

    //     } catch (CognitoIdentityProviderException $e) {
    //         throw $e;
    //     }
    //     return;
    // }
}
