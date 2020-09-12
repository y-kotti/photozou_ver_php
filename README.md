# photozou_ver_php

フォト蔵にアップロードした画像を一括で保存する

## clone
```
git clone https://github.com/y-kotti/photozou_ver_php.git
```

## use
1. index.phpのある階層で、下記を実行
```
php index.php
```

2. コマンドプロンプト上に、必要な情報を入力
- donwload photozou-album id?:
  - 「http://photozou.jp/photo/list/ユーザーID/アルバムID 」のアルバムID（7桁）を入力
- donwload image limit?(1-1000):
  - ダウンロードする画像の枚数を入力
  - フォト蔵APIの制約上一度に1000枚までを推奨としている
  - フォト蔵上で画像の枚数を確認できる
- your photozou id?:
  - フォト蔵でログイン時に使用したメールアドレスを入力
- your photozou password?:
  - フォト蔵でログイン時に使用したパスワードを入力

## output
index.phpと同階層に「Picture_アルバムID_現在の日付」フォルダが作成され、
その下に写真が保存される。

## 参考
https://github.com/irasally/photozousan
