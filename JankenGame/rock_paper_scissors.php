<?php

  // var_dump($_POST);

  // エスケープ用関数 h を定義
  function h($string){
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  }

  class JankenGame {
    
    public $user;
    public $computer;

    public function __construct($user)
    {
      $this->user = $user;
    }

    // 1. コンピューターの手をランダムに決める
    public function computerHand(){
      $pattern  = ['グー', 'チョキ', 'パー'];
      $computer = $pattern[mt_rand(0, 2)];

      // ここでpublic $computer に値を送る
      $this->computer = $computer;

      // フロント側に値を返す
      return $computer;
    }
    
    // 2. ユーザーの手とコンピュータの手を比べて、勝敗を判定する
    public function Judge(){
      
      // ここで $~~ に入れておくことで、後から$this->~~ と書かなくて良いので可読性が高まる
      $user     = $this->user;
      $computer = $this->computer;

      if ($user === $computer) {
        $result = '引き分け';
      } else if (
        $user === 'グー'   && $computer === 'チョキ' || 
        $user === 'チョキ' && $computer === 'パー' || 
        $user === 'パー'   && $computer === 'グー' 
      ) {
        $result = '勝ち';
      } else {
        $result = '負け';
      }
      // 結果の値を返す
      return $result;
    }

  }

  $user = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user']) === true) {
      $user = $_POST['user'];
    }
    
    $JankenGameTest = new JankenGame($user);
    
    $computer = $JankenGameTest->computerHand();
    $result   = $JankenGameTest->Judge();
    
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>じゃんけんゲーム</title>
</head>
<body>
  <h1>じゃんけんゲーム</h1>

  <!--=========== 選択、送信後 ===========-->
  <?php if($_SERVER['REQUEST_METHOD'] === 'POST'){ ?>
  <p>あなたの手：<?php echo h($user); ?></p>
  <p>コンピューターの手：<?php echo h($computer); ?></p>
  <p>結果：<?php echo h($result); ?></p>
  <?php } ?>

  <!--============ 初期画面 ============-->
  <form action="" method="post">
    <label for="">グー</label>
    <input type="radio" name="user" value="グー" <?php if ($user === 'グー') { print 'checked'; } ?>>
    <label for="">チョキ</label>
    <input type="radio" name="user" value="チョキ" <?php if ($user === 'チョキ') { print 'checked'; } ?>>
    <label for="">パー</label>
    <input type="radio" name="user" value="パー" <?php if ($user === 'パー') { print 'checked'; } ?>>
    <input type="submit" value="勝負!" class="submitBtn">
  </form>

</body>
</html>