<?php

class WhiteMage extends Human {
    
    /* プロパティ */
    const MAX_HITPOINT = 80;
    private $hitPoint = 80;
    private $attackPoint = 10;
    private $intelligence = 30; // 魔法の攻撃力を追加する
    
    /* 自身のクラスのインスタンス */
    private static $instance; // インスタンス自体はプライベート
    
    /* constructor */
    private function __construct($name) { // 外部からBraveのpropsを保護する
        parent::__construct( // parent:: 継承元のメソッドを呼び出す
            $name, // nameは書き換えないことを明示する
            $this->hitPoint,
            $this->attackPoint,
            $this->intelligence
        );
    }
    
    // シングルトン（インスタンスへのアクセスはここを通す）
    public static function getInstance($name) {
        if(empty(self::$instance)) { //empty() : 空ならtrue, self:: はhumanクラスを指す
            self::$instance = new Brave($name);
        }
        return self::$instance;
    }
    
    /* doAttackはオーバーライドできない */
    // 引数が親クラスと異なる場合は別メソッドとして定義する
    // 今回は回復するために引数2を持つ必要がある
    public function doAttackWhiteMage($enemies, $members) {
        
        if(!$this->isEnableAttack($enemies)) {
            return false;
        }
        

        if(rand(1, 100) <= 50) {
            $member = $this->selectTarget($members);
            echo "「" . $this->getName() . "」は魔法を唱えた！\n";
            echo "「ぱふぱふ」...\n";
            echo $member->getName() . "のHPが" . $this->intelligence . "回復した！\n";
            $member->recoveryDamage($this->intelligence * 1.5, $member);
        } else {
            $enemy = $this->selectTarget($enemies);
            parent::doAttack($enemies);
        }
        
        return true;
    }
}