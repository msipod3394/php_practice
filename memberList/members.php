<?php

$errors = [];
$lines  = [];

define('FILE_PATH', './members.csv');

// 書き込み処理
$id      = '';
$name    = '';
$address = '';
$tel     = '';

// POSTされていれば一連の書き込み処理を行う
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    // POSTされた文字列の受け取り
    if (isset($_POST['id']) === TRUE) {
        $id = $_POST['id'];
    } else {
      $errors[] = 'idを入力してください';
    }
    
    if (isset($_POST['name']) === TRUE) {
        $name = $_POST['name'];
    } else {
      $errors[] = '名前を入力してください';
    }

    if (isset($_POST['address']) === TRUE) {
        $address = $_POST['address'];
    } else {
      $errors[] = '住所を入力してください';
    }

    if (isset($_POST['tel']) === TRUE) {
        $tel = $_POST['tel'];
    } else {
      $errors[] = '電話番号を入力してください';
    }
    
    if (mb_strlen($id) === 0){
      $errors[] = 'idを入力してください';
    }

    if (mb_strlen($name) === 0){
      $errors[] = '名前を入力してください';
    }
    
    if (mb_strlen($address) === 0){
      $errors[] = '住所を入力してください';
    }    

    if (mb_strlen($tel) === 0){
      $errors[] = '電話番号を入力してください';
    }    

    // エラーがなければ実行する
    if(count($errors) === 0 ){

      // 追記モードでファイルを開く
      $fp = fopen(FILE_PATH, 'a');

      // ファイルを開くのに成功していれば
      if ($fp !== FALSE) {

          // 書き込むテキストを構築。ここでは末尾に改行を付加する
          $log[0] = $id;
          $log[1] = $name;
          $log[2] = $address;
          $log[3] = $tel;

          // 書き込み処理
          $result = fwrite($fp, $id . "," . $name . "," . $address . "," . $tel . "\n");

          if ($result === FALSE) {
              // 書き込みに失敗したらエラーメッセージ
              $errors[] = 'ファイル書き込み失敗:  ' . FILE_PATH;
          }

          // ファイルを閉じる。
          fclose($fp);
      }
    
    }
}

// ファイルが読み込み可能であれば
if (is_readable(FILE_PATH) === TRUE) {

  // 読み込みモードでファイルを開く
  $fp = fopen(FILE_PATH, 'r');

  // 読み込みに失敗していなければ
  if ($fp !== FALSE) {
    $text = fgetcsv($fp);

    // 読み込みが失敗しない間、処理を繰り返す
    while ($text !== false) {
      $lines[] = $text;
      $text = fgetcsv($fp);
    }

    // 処理が終わったらファイルを閉じる
    fclose($fp);

  } else {
    $errors = 'ファイルがありません';
  }

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>名簿作成アプリ</title>
  <style>
    table {
      border-collapse: collapse;
    }

    th,
    td {
      border: solid 1px black;
      padding: 5px;
    }
  </style>
</head>
<body>

  <h1>名簿作成アプリ</h1>

  <form action="" method="post">
    <div>
      ID: <input type="text" name="id">
    </div>
    <div>
      名前: <input type="text" name="name">
    </div>
    <div>
      住所: <input type="text" name="address">
    </div>
    <div>
      電話番号: <input type="text" name="tel">
    </div>
    <input type="submit" value="送信">
  </form>

  <!-- エラーがあればエラー内容を出力 -->
  <?php foreach ($errors as $error) {?>
  <p><?php print $error ?></p>
  <?php }?>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>氏名</th>
        <th>住所</th>
        <th>電話番号</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($lines as $line){ ?>
      <tr>
        <td><?php print $line[0]; ?></td>
        <td><?php print $line[1]; ?></td>
        <td><?php print $line[2]; ?></td>
        <td><?php print $line[3]; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

</body>
</html>