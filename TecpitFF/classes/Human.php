<?php

// クラスの定義
class Human extends Lives {
    
    /* 定数を記述 */
    const MAX_HITPOINT = 100; // 定数は外から再代入できないよう$つけない＆明示的に大文字
    
    /* constructor */
    public function __construct( // 子クラスへ渡すもの
        $name,
        $hitPoint = 100, // デフォルト値を設定できる
        $attackPoint = 20, // デフォルト値を設定できる
        $intelligence = 0 // デフォルト値を設定できる
    ) {
    parent::__construct( // Lives.phpのconstructorから継承するもの
            $name,
            $hitPoint,
            $attackPoint,
            $intelligence
        );
    }
}