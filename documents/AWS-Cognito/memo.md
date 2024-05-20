# AWS Cognito
LaravelでAWS Cognitoを使ってみる。

## IAMユーザ作成
ルートユーザを使って、作業用のIAMユーザを作成する

## AWS SDKをインストール
[参考](https://docs.aws.amazon.com/ja_jp/sdk-for-php/v3/developer-guide/getting-started_installation.html)

- composerを使ってインストール
```bash {iscopy=true}
composer require aws/aws-sdk-php
```

## APIルートを有効化
[参考](https://readouble.com/laravel/11.x/ja/routing.html)

- artisanコマンドを使用して、APIルーティングを有効化
```
sail artisan install:api
```

## TODO
- aws sdk 疎通確認
  - routerに追加
  - controller定義
  - serviceクラス定義
- ユーザプール作成
- 認証機能作成
