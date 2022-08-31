<head></head>
<body>
<p>新規お問い合わせを下記の内容で受け付けました。</p>
<br>
<p>＊名前</p>
<p>{{ $contact['name'] }}</p>
<br>
<p>＊メールアドレス</p>
<p>{{ $contact['email'] }}</p>
<br>
<p>＊問い合わせ内容</p>
<p>{{ $contact['category'] }}</p>
<br>
<p>＊問い合わせ詳細</p>
<p>{!! nl2br(e($contact['message'])) !!}</p><br>
_________________<br>
<p>ShareHW</p>
<br>
<p>株式会社ASDF</p>
<p>住所：ABC県DEF市123-1</p>
<p>担当部署：ZXC部</p>
<p>メールアドレス：sharehw@example.com</p>
</body>
