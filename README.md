# qskype

View the Skype messages on a browser via **Q**uery **SKYPE** sqlite database in your local machine.

## 概要
Skype が持つデータベースファイル main.db を参照し、発言内容をブラウザから見れるようにするもの。

![screenshot](https://raw.githubusercontent.com/kobake/qskype/master/screenshots/screenshot.png?token=ACyzLjJwm9kwGVBsrWIM_j80oKjzToGAks5Vj68vwA%3D%3D)

## [Skype for Web](https://web.skype.com/) との違い
### メリット
- メッセージの検索がしやすい、はず。

### デメリット
- 閲覧のみで、発言はできない。

### その他言及
決して車輪の再発明をしたかったわけではなく、本 qskype の完成間近に先に [Skype for Web](https://web.skype.com/) が発表されてしまったというだけの話です。

## 想定環境

Skype がインストールされているマシン。

- Linux … CentOS 6.6, Red Hat Enterprise Linux 7.1 で動作確認済み
- Mac … 試してないけどイケる気がする
- Windows … 試してない

## Setup
### Required modules
```bash
yum -y install php php-mbstring php-pdo
yum -y install httpd
```

### Apache 設定
```
AllowOverride All
```

### 設置
```bash
cd /var/www/html
git clone git@github.com:kobake/qskype.git
service httpd start
```

### qskype 設定
ブラウザから行う。基本的にはガイドに従っていけばOK。

![screenshot](https://raw.githubusercontent.com/kobake/qskype/master/screenshots/1.png?token=ACyzLjJwm9kwGVBsrWIM_j80oKjzToGAks5Vj68vwA%3D%3D)
![screenshot](https://raw.githubusercontent.com/kobake/qskype/master/screenshots/2.png?token=ACyzLjJwm9kwGVBsrWIM_j80oKjzToGAks5Vj68vwA%3D%3D)
![screenshot](https://raw.githubusercontent.com/kobake/qskype/master/screenshots/3.png?token=ACyzLjJwm9kwGVBsrWIM_j80oKjzToGAks5Vj68vwA%3D%3D)
![screenshot](https://raw.githubusercontent.com/kobake/qskype/master/screenshots/4.png?token=ACyzLjJwm9kwGVBsrWIM_j80oKjzToGAks5Vj68vwA%3D%3D)
![screenshot](https://raw.githubusercontent.com/kobake/qskype/master/screenshots/5.png?token=ACyzLjJwm9kwGVBsrWIM_j80oKjzToGAks5Vj68vwA%3D%3D)
![screenshot](https://raw.githubusercontent.com/kobake/qskype/master/screenshots/6.png?token=ACyzLjJwm9kwGVBsrWIM_j80oKjzToGAks5Vj68vwA%3D%3D)