<?php

class BlackMage extends Human {
    
    /* プロパティ */
    const MAX_HITPOINT = 80;
    private $hitPoint = self::MAX_HITPOINT;
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
    
    /* doAttackをオーバーライド */
    public function doAttack($enemy) {
        if(rand(1,2) >= 1) {
            echo "「" . $this->getName() . "」は魔法を唱えた！\n";
            echo "「バルス」!!\n";
            echo $enemy->getName() . "に" . $this->intelligence . "のダメージ！\n";
            $enemy->tookDamage($this->intelligence * 1.5);
        } else {
            parent::doAttack($enemy);
        }
    }
}