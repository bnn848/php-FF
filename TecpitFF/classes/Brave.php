<?php

/* Humanクラスを継承する */
class Brave extends Human {
    
    /* 親クラスのプロパティを上書きする */
    const MAX_HITPOINT = 120;
    public $hitPoint = self::MAX_HITPOINT; // self:: 子クラス自身を指す
    private $attackPoint = 30;
    
    /* constructor */
    public function __construct($name) { // 外部からBraveのpropsを保護する
        parent::__construct( // parent:: 継承元のメソッドを呼び出す
            $name, // nameは書き換えないことを明示する
            $this->hitPoint,
            $this->attackPoint
        );
    }
    
    /* スキルの発動(human.doAttackを上書きする)*/
    public function doAttack($enemy) {
        if (rand(1, 100) <= 30) { // min~maxの乱数生成 === 1の時（3分の１の確率）
            echo "「" . $this->getName() . "」はスキルを発動した！\n";
            echo "「肉球パンチ」!!\n";
            echo $enemy->getName() . "に" . $this->attackPoint  * 1.5 . "のダメージ！\n";
            $enemy->tookDamage($this->attackPoint * 1.5);
        } else {
            parent::doAttack($enemy); // 親クラスメソッドを呼び出す::
        }
        return true;
        
    }
}