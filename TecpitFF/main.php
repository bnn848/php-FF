<?php

/* ファイルをロードする */
require_once('./classes/Human.php');
require_once('./classes/Brave.php');
require_once('./classes/Enemy.php');
require_once('./classes/WhiteMage.php');
require_once('./classes/BlackMage.php');

/* クラスをインスタンス化（クラスへの参照を可能にする） */
// $player = new Brave("ももちゃん"); // プレイヤー
// $goblin = new Enemy("ゴブリン"); // ゴブリン（敵キャラ）
$members = array(); // 各クラスインスタンスを配列で保持する
$members[] = new Brave('ゆきちくん');
$members[] = new WhiteMage('いちよちゃん');
$members[] = new BlackMage('ひでよくん');

$enemies = array(); // 初期化はこのように記述する
$enemies[] = new Enemy('ごぶりん1', 20);
$enemies[] = new Enemy('ごぶりん2', 25);
$enemies[] = new Enemy('ごぶりん3', 30);

/* nameプロパティを設定 */
// $player->name = "ももちゃん"; // 引数1に名前を渡すことでconstructorにセットする
// $goblin->name = "ゴブリン";

/* turnの管理 */
$turn = 1; // 初期値1
$isFinish = false; // 初期値falseで戦闘終了の際にtrueにする


/* 以下、繰り返し処理 どちらも生きている限り以下の処理を繰り返す */
// getterメソッドじゃないとアクセスできない
// while($player->hitPoint > 0 && $goblin->hitPoint > 0) {
// while($player->getHitPoint() > 0 && $goblin->getHitPoint() > 0) {
while(!$isFinish) { // $isfinish = falseの間繰り返す
    
    echo "*** $turn ターン目 ***\n\n";// プロパティを参照しないなら.で繋げる必要はない
 
    /* 
        HPを表示する
    */
    
    // 味方パーティ
    foreach($members as $member) {
        echo $member->getName() . ":" . $member->getHitPoint() . "/" . $member::MAX_HITPOINT .  "\n"; // オブジェクト定数の参照は::
    }
    echo "\n";
    
    // 敵パーティ
    foreach($enemies as $enemy) {
        echo $enemy->getName() . ":" . $enemy->getHitPoint() . "/" . $enemy::MAX_HITPOINT .  "\n"; // オブジェクト定数の参照は::
    }
    echo "\n";
    
    
    /* 
        攻撃メソッドの実装
    */
    
    // 味方パーティの攻撃
    foreach($members as $member) {
        // 攻撃対象をランダムで決定
        $enemyIndex = rand(0, count($enemies) - 1); // 0~キャラの数-1までインデックスを指定
        $enemy = $enemies[$enemyIndex]; // 指定したインデックスでキャラを特定
        
        // 回復スキルでは味方オブジェクトも返す必要があるため、条件分岐
        if(get_class($member) == "WhiteMage") { // get_class(): クラスインスタンスを返すメソッド
            $member->doAttackWhiteMage($enemies, $members);
        } else {
            $member->doAttack($enemies); // 引数に攻撃対象を受け取る
        }
        echo "\n";
    }
    echo "\n";
    
    // 敵パーティの攻撃
    foreach($enemies as $enemy) {
        // $memberIndex = rand(0, count($members) - 1); // count():引数の数を返す
        // $member = $members[$memberIndex];
        $enemy->doAttack($members);
        echo "\n";
    }
    
    
    /*
        どちらかのパーティが全滅したら戦闘終了
        死んだ数をカウントして死んだ数＝メンバー数になったら$isFinish = true;
    */
    
    // 仲間全滅チェック
    $deathCount = 0; // 初期化
    
    foreach($members as $member) { // 一人ずつチェックする
        if($member->getHitPoint() > 0) { // getterを通して現在の体力を取得
            $isFinish = false;
            break; // 一人でも生きていればforeachメソッドを抜ける
        }
        $deathCount += 1; // 死んでいればカウントをプラス
    }
    
    if($deathCount === count($members)) {
        $isFinish = true;
        echo "GAME OVER ...\n\n";
        break; // whileを抜け、$turn++;を無視して戦闘終了にする
    }
    
    // 敵全滅チェック
    $killCount = 0;
    
    foreach($enemies as $enemy) {
        if($enemy->getHitPoint() > 0) {
            $isfinish = false;
            break;
        }
        $killCount += 1;
    }
    
    if($killCount === count($enemies)) {
        $isFinish = true;
        echo "You are Win!!!\n\n";
        break;
    }
    
    
    $turn++; // ターン数を+1して終了
};


/*
    戦闘終了
*/

foreach($members as $member) {
    echo $member->getName() . ":" . $member->getHitPoint() . "/" . $member::MAX_HITPOINT . "\n";
}
echo "\n";

foreach($enemies as $enemy) {
echo $enemy->getName() . ":" . $enemy->getHitPoint() . "/" . $enemy::MAX_HITPOINT . "\n";
}
echo "\n";
