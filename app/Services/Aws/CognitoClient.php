<?php

namespace App\Services\Aws;

// SDKの中から使うクラス
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;

class CognitoClient
{
    protected CognitoIdentityProviderClient $client;
    protected $clientId;
    protected $clientSecret;
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
      $this->clientId = config('aws.cognito.client_id');
      $this->clientSecret = config('aws.cognito.client_secret');
      $this->poolId = config('aws.cognito.user_pool_id');
    }

    public function listUsers()
    {
      $users = $this->client->listUsers([
        'UserPoolId' => $this->poolId,
      ]);
      var_dump($users);
    }

    public function createUser($email)
    {
      $response = $this->client->adminCreateUser([
        'UserPoolId' => $this->poolId,
        'Username' => $email,
      ]);
      dd($response);
    }

    public function signIn($email, $password)
    {
      $response = $this->client->adminInitiateAuth([
        'AuthFlow' => 'ADMIN_USER_PASSWORD_AUTH',
        'AuthParameters' => [
          'USERNAME' => $email,
          'PASSWORD' => $password,
          'SECRET_HASH' => $this->secretHash($email),
        ],
        'ClientId' => $this->clientId,
        'UserPoolId' => $this->poolId,
      ]);
      dd($response);
      if($response['Session']) {
        return [
          'challengeName' => $response['ChallengeName'],
          'session' => $response['Session'],
        ];
      } else {
        return [
          'access'
        ];
      }
    }

    public function initialPasswordChange($username, $password, $session)
    {
      $response = $this->client->adminRespondToAuthChallenge([
        'ChallengeName' => 'NEW_PASSWORD_REQUIRED',
        'ChallengeResponses' => [
          'USERNAME' => $username,
          'NEW_PASSWORD' => $password,
          'SECRET_HASH' => $this->secretHash($username),
        ],
        'Session' => $session,
        'ClientId' => $this->clientId,
        'UserPoolId' => $this->poolId,
      ]);
      dd($response);
    }

    public function changePassword($username, $password, $permanent = true)
    {
      $this->client->adminSetUserPassword([
        'Password' => $password,
        'Permanent' => $permanent,
        'Username' => $username,
        'UserPoolId' => $this->poolId,
      ]);
    }
    
    public function signUp($email, $password) {
      try {
          $this->client->signUp([
              'ClientId' => $this->clientId,
              'SecretHash' => $this->secretHash($email),
              'Username' => $email,
              'Password' => $password,
              'UserAttributes' => [
                [
                  'Name' => 'email',
                  'Value' => $email,
                ],
              ],
          ]);
      } catch (CognitoIdentityProviderException $e) {
          throw $e;
      }
    }

    private function secretHash($username)
    {
      $hash = hash_hmac('sha256', $username . $this->clientId, $this->clientSecret, true);
      return base64_encode($hash);
    }
}
