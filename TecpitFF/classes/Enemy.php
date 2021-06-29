<?php

// クラスの定義
class Enemy extends Lives {
    
    /* 定数を記述 */
    const MAX_HITPOINT = 100; // 定数は外から再代入できないよう$つけない＆明示的に大文字

    /* constructor */
    public function __construct($name, $attackPoint) {
        $hitPoint = 100;
        $intelligance = 0;
        parent::__construct (
                $name,
                $hitPoint,
                $attackPoint,
                $intelligance
            );
    }
  
}