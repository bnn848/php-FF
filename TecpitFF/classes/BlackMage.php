<?php

class BlackMage extends Human {
    
    /* プロパティ */
    const MAX_HITPOINT = 80;
    private $hitPoint = self::MAX_HITPOINT;
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
    
    /* doAttackをオーバーライド */
    public function doAttack($enemies) {
        
        if(!$this->isEnableAttack($enemies)) {
            return false;
        }
        
        $enemy = $this->selectTarget($enemies);
        
        if(rand(1,100) >= 50) { // 50%の確率
            echo "「" . $this->getName() . "」は魔法を唱えた！\n";
            echo "「バルス」!!\n";
            echo $enemy->getName() . "に" . $this->intelligence * 1.5 . "のダメージ！\n";
            $enemy->tookDamage($this->intelligence * 1.5);
        } else {
            parent::doAttack($enemies);
        }
    }
}