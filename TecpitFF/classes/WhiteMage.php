<?php

class WhiteMage extends Human {
    
    /* プロパティ */
    const MAX_HITPOINT = 80;
    private $hitPoint = 80;
    private $attackPoint = 10;
    private $intelligence = 30; // 魔法の攻撃力を追加する
    
    /* constructor */
    public function __construct($name) { // 外部からBraveのpropsを保護する
        parent::__construct( // parent:: 継承元のメソッドを呼び出す
            $name, // nameは書き換えないことを明示する
            $this->hitPoint,
            $this->attackPoint,
            $this->intelligence
        );
    }
    
    /* doAttackはオーバーライドできない */
    // 引数が親クラスと異なる場合は別メソッドとして定義する
    // 今回は回復するために引数2を持つ必要がある
    public function doAttackWhiteMage($enemy, $human) {
        if(rand(1,2) >= 1) {
            echo "「" . $this->getName() . "」は魔法を唱えた！\n";
            echo "「ぱふぱふ」...\n";
            echo $human->getName() . "のHPが" . $this->intelligence . "回復した！\n";
            $human->recoveryDamage($this->intelligence * 1.5, $human);
        } else {
            parent::doAttack($enemy);
        }
        
        return true;
    }
}