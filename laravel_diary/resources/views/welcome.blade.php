<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>【Laravel6基礎】制作課題一覧</title>
</head>
<style>
    dl{
        width: 700px;
        border-top: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        display: flex;
        margin: 0;
    }
    dl:last-child{
        border-bottom: 1px solid #ccc;
    }    
    dl dt{
        width: 100px;
        border-left: 4px solid #00a4ff;
        margin: 0;
        padding: 5px 5px 5px 10px;
        display: block;
    }
    dl dd{
        width: 600px;
        margin: 0;
        padding: 5px 5px 5px 0px;
        display: block;
    }
    dd a{
        display: block;
        color: #333;
        transition: all .3s;
    }
    dd a:hover{
        color: #00a4ff;
    }
</style>
<body>
    <h1>【Laravel6基礎】制作課題一覧</h1>
    <dl>
        <dt>3章</dt>
        <dd>
            <a href="/practice">[3-7] 現在のルートの URL を取得する</a>
        </dd>
    </dl>
    <dl>
        <dt>4章</dt>
        <dd>
            <a href="/about">[4-9] このアプリについて</a>
        </dd>
    </dl>
    <dl>
        <dt>5章</dt>
        <dd>
            <a href="/message_create/create">[5-8] 新規投稿ページ</a>
        </dd>
    </dl>
    <dl>
        <dt>6章</dt>
        <dd>
            <a href="/show_profile">[6-9] プロフィール</a>
        </dd>
    </dl>
    <dl>
        <dt>7章</dt>
        <dd>
            <a href="/item/1">[7-7] 課題 1: ルーティングパラメータ </a>
            <a href="/form_practice">[7-8] 課題2: POST</a>
        </dd>
    </dl>    
    <dl>
        <dt>11章</dt>
        <dd>
            <a href="/diaries">【提出課題】日記一覧</a>
        </dd>
    </dl>
    
</body>
</html>