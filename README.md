# ![Share HW](https://raw.githubusercontent.com/penguin513/ShareHW/master/ShareHW/public/img/ShareHW_logo.png)
## 概要
ShareHW(Share House Works)は日々の家事をリスト化し共有することで、

**共同生活を円滑かつ豊か**にする目的に作られたアプリです。

## 開発背景
昨今共働きの世帯が増え、

従来のような **『誰か特定の一人が家事をする』** という考え方から **『みんなで協力して行う』** という風に変化しつつあります。

また、家事というものはなかなか目に見えにくくその大変さが顕在化しにくいという面があり、それがもとで家庭内でのトラブルを生むケースもあります。

そこで、家事を可視化させ誰がどのくらい普段労力を使っているのかをお互いに把握しあうことで、

**その労力をより公平化したり日頃の感謝を伝えるきっかけを作る**といった目的で本アプリを作成しました。

## 主な機能
- 登録した家事を同じ部屋のユーザに共有し、ステータス（進行状況）等を同期する
- 同じ部屋のユーザそれぞれの全体に占める家事の担当割合をチャートにすることで可視化する
- ユーザの居住地域のその日（20時以降は次の日）の天気を取得し、天気に合わせた家事を提案する
- スケジュールに家事を登録し、その日の家事をクリック一つで簡単に追加する（該当の曜日の家事のテンプレートを作成できる）
- 自分の家で使っている商品の情報を登録できる
- 同じ部屋のユーザ間でチャットを使って意思疎通をとれる

## 開発環境
Windows / XAMPP / MySQL / Laravel

## 導入説明
１．ShareHWをダウンロードし、XAMPPまたはMAMPのhtdocsにフォルダごと入れてください。

２．ご自身のDBに「sharehw」というデータベースを作成し、「sharehw.sql.zip」をダウンロード後インポートしてください。

３．Mailtrapにアカウント登録後、アカウント情報、自身のデータベース情報を.env.exampleを参考に.envファイルを作成してください。

４．お使いのXAMPPまたはMAMPの「httpd.conf」の
```
DocumentRoot "C:/xampp/htdocs"
<Directory "C:/xampp/htdocs">
```

を


```
DocumentRoot "C:/xampp/htdocs/ShareHW/public"
<Directory "C:/xampp/htdocs/ShareHW/public">
```

に書き換えてください

５．nodeとnpmをインストール後、コマンド上でShareHWのファイルが存在するディレクトリまで移動し、

```
php artisan storage:link
npm run dev
```

を実行してください。

※参考　https://qiita.com/mk185/items/7ad004bf202f400daea1

６．http://localhost （各自環境に合わせて変化）にアクセス後ログイン画面が表示されるので、新規ユーザ登録をするか初期ユーザとして次の2つのアカウントが既に登録してありますので、そちらを適宜お使いください。

###### ①管理者テストユーザ

メールアドレス：admin@sharehw.com

パスワード　　：passwordadmin

###### ②一般テストユーザ

メールアドレス：general@sharehw.com

パスワード　　：passwordgeneral

## データベース
sharehw.sql.zip（ご自由にダウンロードしてお使いください）
