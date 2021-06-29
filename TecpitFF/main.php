<?php

/* ファイルをロードする */
// require_once('./classes/Lives.php');
// require_once('./classes/Human.php');
// require_once('./classes/Brave.php');
// require_once('./classes/Enemy.php');
// require_once('./classes/WhiteMage.php');
// require_once('./classes/BlackMage.php');
// require_once('./classes/Message.php');
require_once('./lib/Loader.php'); // 自動ロード化する
require_once('./lib/Utility.php');

$loader = new Loader();

$loader->regDirectory(__DIR__ . '/classes'); // __DIR__ : 現在のフルパスを取得
$loader->regDirectory(__DIR__ . '/classes/constants');
$loader->register();

/* クラスをインスタンス化（クラスへの参照を可能にする） */
// $player = new Brave("ももちゃん"); // プレイヤー
// $goblin = new Enemy("ゴブリン"); // ゴブリン（敵キャラ）
$members = array(); // 各クラスインスタンスを配列で保持する
$members[] = new Brave(CharacterName::YUKICHI);
// $members[] = Brave::getInstance(CharacterName::YUKICHI);
$members[] = WhiteMage::getInstance(CharacterName::ICHIYO);
$members[] = BlackMage::getInstance(CharacterName::HIDEYO);

$enemies = array(); // 初期化はこのように記述する
$enemies[] = new Enemy(EnemyName::GOBLINS1 , 30);
$enemies[] = new Enemy(EnemyName::GOBLINS2, 35);
$enemies[] = new Enemy(EnemyName::GOBLINS3, 40);

/* nameプロパティを設定 */
// $player->name = "ももちゃん"; // 引数1に名前を渡すことでconstructorにセットする
// $goblin->name = "ゴブリン";

/* turnの管理 */
$turn = 1; // 初期値1
$isFinishFlg = false; // 初期値falseで戦闘終了の際にtrueにする

/* messageObj */
$messageObj = new Message;

/* 以下、繰り返し処理 どちらも生きている限り以下の処理を繰り返す */
// getterメソッドじゃないとアクセスできない
// while($player->hitPoint > 0 && $goblin->hitPoint > 0) {
// while($player->getHitPoint() > 0 && $goblin->getHitPoint() > 0) {
while(!$isFinishFlg) { // $isfinish = falseの間繰り返す
    
    echo "*** $turn ターン目 ***\n\n";// プロパティを参照しないなら.で繋げる必要はない
 
    /* 
        HPの表示
    */
    // 味方パーティ
    $messageObj->displayStatusMessage($members);
    // 敵パーティ
    $messageObj->displayStatusMessage($enemies);
    
    
    /* 
        攻撃メソッドの表示
    */
    // 味方パーティの攻撃
    $messageObj->displayAttackMessage($members, $enemies);
    // 敵パーティの攻撃
    $messageObj->displayAttackMessage($enemies, $members);
    
    
    /* 戦闘終了条件のチェック*/
    
    // 味方パーティの生存確認
    $isFinishFlg = isFinish($members);
    if($isFinishFlg) {
        $message = "You are Dead...\n\n";
        break;
    }
    // 敵パーティの生存確認
    $isFinishFlg = isFinish($enemies);
    if($isFinishFlg) {
        $message = "Congratulation!!!\n\n";
        break;
    }
    
    
    $turn++; // ターン数を+1して終了
};

/*
    戦闘終了
*/
echo "=====戦闘終了=====\n";
echo $message;


$messageObj->displayStatusMessage($members);
$messageObj->displayStatusMessage($enemies);
