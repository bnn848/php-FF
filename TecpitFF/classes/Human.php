<?php

// クラスの定義
class Human {
    
    /* コンストラクター */
    const MAX_HITPOINT = 100; // 定数は外から再代入できないよう$つけない＆明示的に大文字
    private $name; // クラス外からアクセスできる変数にはpublic $つけて小文字
    private $hitPoint = 100;
    private $attackPoint = 30;
    
    /* 以下メソッドを記述 */
    
    //constructor（インスタンス生成時一回のみ実行可能）
    public function __construct(
            $name,
            $hitPoint = 100, // デフォルト値を設定できる
            $attackPoint = 30// デフォルト値を設定できる
        ) {
        $this->name = $name; // nameの代入はmain.phpにて一回のみ有効とする
        $this->hitPoint = $hitPoint;
        $this->attackPoint = $attackPoint;
        
    }
    
    // doAttack
    public function doAttack($enemy) {
        echo "「".$this->getName() . "」の攻撃！\n"; // クラス自身のプロパティを参照
        echo "「".$enemy->getName() . "」に" . $this->attackPoint . "のダメージ！\n";
        $enemy->tookDamage($this->attackPoint);
    }
    
    // tookDamage
    public function tookDamage($damage) {
        $this->hitPoint -= $damage; // 現在の体力からダメージ分引く
        if($this->hitPoint <= 0) { // 体力は0以下にならない。
            $this->hitPoint = 0;
            echo $this->name . "は倒れた！\n";
        }
    }
    
    // recoveryDamage
    public function recoveryDamage($heal, $target) { // intelliganceを$healで受け取る
        $this->hitPoint += $heal; // hitpointを$healの値増やす
        if($this->hitPoint > $target::MAX_HITPOINT) { // targetの継承元を参照
            $this->hitPoint = $target::MAX_HITPOINT;
        }
    }
    
    // privateプロパティにアクセスさせるためのメソッド（getter）
    public function getName() { // メソッド自体はpublicなので外部アクセス可能
        return $this->name; // アクセス許可するプロパティを返す
    }
    
    public function getHitPoint() { // メソッド自体はpublicなので外部アクセス可能
        return $this->hitPoint; // アクセス許可するプロパティを返す
    }
    
    public function getAttackPoint() { // メソッド自体はpublicなので外部アクセス可能
        return $this->attackPoint; // アクセス許可するプロパティを返す
    }
    
    
    // constructメソッドに記述するためコメントアウト
    // // privateプロパティにアクセスするためのメソッド（setter）
    // public function setName($name) { //外部で定義したnameを受け取る
    //     $this->name = $name; // 受け取ったnameを自身のプロパティにセットする
    // }
    
}