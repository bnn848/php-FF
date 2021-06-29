<?php

// クラスの定義
class Enemy {
    
    /* コンストラクター */
    const MAX_HITPOINT = 300; // 定数は外から再代入できないよう$つけない＆明示的に大文字
    private $name; // クラス外からアクセスできる変数にはpublic $つけて小文字
    private $hitPoint = self::MAX_HITPOINT;
    private $attackPoint = 500;
    
    /* 以下メソッドを記述 */
    
    // コンストラクタメソッド
    public function __construct($name, $attackPoint) {
        $this->name = $name;
        $this->attackPoint = $attackPoint;
    }
    
    // doAttack
    public function doAttack($humans) {
        
        if($this->hitPoint <= 0) {
            return false;
        }
        
        $humanIndex = rand(0, count($humans) - 1);
        $human = $humans[$humanIndex];
        
        if(rand(1, 100) <= 30) {
            echo "「".$this->getName() . "」の攻撃！\n"; 
            echo "急所にあたった!\n";
            echo "「".$human->getName() . "」に" . $this->attackPoint * 2 . "のダメージ！\n";
            $human->tookDamage($this->attackPoint * 2);
        } else {
            echo "「".$this->getName() . "」の攻撃！\n"; // クラス自身のプロパティを参照
            echo "「".$human->getName() . "」に" . $this->attackPoint . "のダメージ！\n";
            $human->tookDamage($this->attackPoint);
        }
        return true;
    
    }
    
    // tookDamage
    public function tookDamage($damage) {
        
        $this->hitPoint -= $damage; // 現在の体力からダメージ分引く
        if($this->hitPoint < 0) { // 体力は0以下にならない。
            $this->hitPoint = 0;
            echo $this->name . "は倒れた！\n";
        }
    }
    
    // getter
    public function getName() {
        return $this->name;
    }
    
    public function getHitPoint() {
        return $this->hitPoint;
    }
    
    public function getAttackPoint() {
        return $this->attackPoint;
    }
    
}