<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ secure_asset('css/styles.css') }}">
    <style>
        div {
            margin: 10px 0;
        }
        /* エラーメッセージ用のスタイル */
        .error {
          color: red;
        }
    </style>
</head>
<body>
    
    {{-- エラーメッセージを出力 --}}
    @foreach($errors->all() as $error)
        <p class="error">{{ $error }}</p>
    @endforeach
    
    @yield('contents')
</body>
</html>