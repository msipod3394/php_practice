<?php

  // エスケープ用関数 h を定義
  function h($string){
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  }

  // 読み込むファイルパス
  define('FILE_PATH', './bbs.txt');
  
  // タイムゾーンの取得
  date_default_timezone_set('Asia/Tokyo');

  $errors = [];
  $lines  = [];

  $name    = '';
  $comment = '';

  // POSTされていれば一連の書き込み処理を行う
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
      // POSTされた文字列の受け取り
      if (isset($_POST['name']) === TRUE) {
          $name = $_POST['name'];
      } else {
        $errors[] = '名前を入力してください';
      }

      if (isset($_POST['comment']) === TRUE) {
          $comment = $_POST['comment'];
      } else {
        $errors[] = 'ひとことを入力してください';
      }
      
      // スペースを除去
      $name    = str_replace(array(" ", "　"), "", $name);
      $comment = str_replace(array(" ", "　"), "", $comment);

      // 文字数エラーチェック
      if (mb_strlen($name) === 0) {
        $errors[] = '名前を入力してください';
      } else if (mb_strlen($name) >= 21) {
        $errors[] = '名前は、20文字以内で入力してください';
      }

      if (mb_strlen($comment) === 0) {
        $errors[] = 'ひとことを入力してください';
      } else if ((mb_strlen($comment) >= 101)) {
        $errors[] = 'ひとことは、100文字以内で入力してください';
      }

      // エラーがなければ実行する
      if (count($errors) === 0) {

        // 追記モードでファイルを開く
        $fp = fopen(FILE_PATH, 'a');

        // ファイルを開くのに成功していれば
        if ($fp !== FALSE) {
    
            // タイムゾーン設定・日時の取得
            $today = date("Y年m月d日 H時i分s秒");

            // 書き込むテキストを構築。ここでは末尾に改行を付加する。
            $log = $name . ': ' . $comment . ' - ' . $today . "\n";

            // 書き込み処理
            $result = fwrite($fp, $log);

            if ($result === FALSE) {
                // 書き込みに失敗したらエラーメッセージ
                $errors[] = 'ファイル書き込み失敗:  ' . FILE_PATH;
            }

            // ファイルを閉じる
            fclose($fp);
        }
      }
  
  }

  // 読み込み可能であれば
  if (is_readable(FILE_PATH) === TRUE) {
    
    // 読み込みモードでファイルを開く
    $fp = fopen(FILE_PATH, 'r');
    
    // 読み込みモードに失敗していなければ
    if ($fp !== FALSE) {
      
      // 一行読み込む
      $text = fgets($fp);

      // 読み込みが失敗していなければ
      while ($text !== FALSE) {

        // 一行分のテキストを配列に追加
        // 最新の書き込みが一番上に表示されるようにする
        array_unshift($lines, $text);
        
        // 次の一行を読み込む
        $text = fgets($fp);
      }

      // 利用し終えたらファイルを閉じる
      fclose($fp);
    } 
  } else {
    $errors[] = 'ファイルがありません';
  }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ひとこと掲示板</title>
  <style>
    .error {
      margin: 0;
      padding: 0;
      color: red;
    }
  </style>
</head>
<body>

  <h1>ひとこと掲示板</h1>

  <ul>
    <?php foreach ($errors as $error) { ?>
    <li class="error"><?php echo h($error); ?></li>
    <?php } ?>
  </ul>

  <form action="" method="post">
    名前: <input type="text" name="name">
    ひとこと: <input type="text" name="comment" size="60">
    <input type="submit" name="submit" value="送信">
  </form>

  <ul>
    <?php foreach ($lines as $line) { ?>
    <li><?php echo h($line); ?></li>
    <?php } ?>
  </ul>

</body>
</html>