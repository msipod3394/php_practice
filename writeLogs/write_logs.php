<?php

  $errors = [];
  $lines  = [];

  // 読み込むファイルパス
  define('FILE_PATH', './logs.txt');
  
  $comment = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      // POSTされていれば一連の書き込み処理を行う。
  
      // POSTされた文字列の受け取り
      if (isset($_POST['comment']) === TRUE) {
          $comment = $_POST['comment'];
      }
  
      // 追記モードでファイルを開く
      $fp = fopen(FILE_PATH, 'a');
      if ($fp !== FALSE) {
          // ファイルを開くのに成功していれば
  
          // 書き込むテキストを構築。ここでは末尾に改行を付加する。
          $log = $comment . "\n";
          // 書き込み処理

          $result = fwrite($fp, $log);
          if ($result === FALSE) {
              // 書き込みに失敗したらエラーメッセージ
              $errors[] = 'ファイル書き込み失敗:  ' . FILE_PATH;
          }
          
          // ファイルを閉じる。
          fclose($fp);
      }
  }

  // 読み込み可能であれば
  if (is_readable(FILE_PATH) === TRUE) {
    
    // 読み込みモードでファイルを開く
    $fp = fopen(FILE_PATH, 'r');
    
    // 読み込みモードに失敗していなければ
    if ($fp !== false) {
      
      // 一行読み込む
      $text = fgets($fp);

      // タイムゾーン設定・日時の取得
      date_default_timezone_set('Asia/Tokyo');
      $today = date("Y年m月d日 H時i分s秒");

      // 読み込みが失敗していなければ
      while ($text !== false) {
        // 一行分のテキストを配列に追加する
        $lines[] = $text . $today;

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
  <title>発言ログ</title>
</head>
<body>

  <h1>発言ログ</h1>

  <form action="" method="post">
    <input type="text" name="comment">
    <input type="submit" name="submit" value="送信">
  </form>

  <?php foreach ($errors as $error) { ?>
  <p><?php print $error; ?></p>
  <?php } ?>

  <p>以下に<?php print FILE_PATH; ?>の中身を表示</p>

  <ul>
    <?php foreach ($lines as $line) { ?>
    <li><?php print $line; ?></li>
    <?php } ?>
  </ul>

</body>
</html>