<?php

class Lives {
    
    /* プロパティ */
    private $name;
    private $hitPoint;
    private $attackPoint;
    private $intelligance;
    
    
    /* constructor */
    public function __construct(
            $name,
            $hitPoint = 50,
            $attackPoint = 10,
            $intelligance = 0
        ) {
            $this->name = $name;
            $this->hitPoint = $hitPoint;
            $this->attackPoint = $attackPoint;
            $this->intelligance = $intelligance;
        }
    
    /* getName() */
    public function getName() {
        return $this->name;
    }
    
    /* getHitPoint() */
    public function getHitPoint() {
        $result = $this->hitPoint; // ---> 現在の体力＝攻撃を受けた後のresult
        if($result < 0) {
            $result = 0;
        }
        return $result;
    }
    
    /* tookDamage() */
    public function tookDamage($damage) {
        $this->hitPoint -= $damage;
        if($this->hitPoint <= 0) {
            $this->hitPoint = 0;
        }
    }
    
    /* recoveryDamage */
    public function recoverydamage($heal, $target) {
        $this->hitPoint += $heal;
        if($this->hitPoint > $target::MAX_HITPOINT) {
            $this->hitPoint = $target::MAX_HITPOINT;
        }
    }
    
    /* isEnableAttack */ // 死体撃ちしないため
    public function isEnableAttack($targets) {
        
        // (1)自分が死んでいるか？
        if($this->hitPoint <= 0) {
            return false; // ---> 死んでる場合は攻撃不可
        }
        
        //(2)敵が全員死んでいるか？
        $isAllDie = true;
        foreach($targets as $target) {
            if($target->getHitPoint() > 0) {
                $isAllDie = false;
            }
        }
        if ($isAllDie) {
            return false; // ---> 全員死んでる場合は攻撃不可
        }
        
        // (3) 1および2がfalseのとき攻撃可能
        return true;
    }
    
    /* selectTarget() */
    public function selectTarget($targets) {
        $target = $targets[rand(0, count($targets) -1)];
        while($target->getHitPoint() <= 0) { // 選んだ相手が死んでいた場合
            $target = $targets[rand(0, count($targets) - 1)]; // 再度targetを設定
        }
        return $target; // 生きているtargetを返す
    }
    
    /* doAttack() */
    public function doAttack($targets) {
        if(!$this->isEnableAttack($targets)) {
            return false;
        }
        
        $target = $this->selectTarget($targets);
        echo "「".$this->getName() . "」の攻撃！\n";
        echo "「".$target->getName() . "」に" . $this->attackPoint . "のダメージ！\n";
        $target->tookDamage($this->attackPoint);
        if($target->hitPoint <= 0) {
            echo $target->getName() . "は倒れた。";
        }
        return true;
    }
    
}