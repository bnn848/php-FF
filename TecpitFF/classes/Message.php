<?php

/* 共通の表示を抽出 */
class Message {
    // ステータス表示
    public function displayStatusMessage($objects) {
        
        foreach($objects as $object) {
            echo $object->getName() . ":" . $object->getHitPoint() . "/" . $object::MAX_HITPOINT .  "\n";
        }
        echo "\n";
    }
    
    // 攻撃表示
    public function displayAttackMessage($objects, $targets) {

        foreach($objects as $object) {
            // 回復スキルでは味方オブジェクトも返す必要があるため、条件分岐
            if(get_class($object) == "WhiteMage") { // get_class(): クラスインスタンスを返すメソッド
                $attackResult = $object->doAttackWhiteMage($targets, $objects);
            } else {
               $attackResult = $object->doAttack($targets); // 引数に攻撃対象を受け取る
            }
            
            if($attackResult) { // === true:
                echo "\n";
            }
            
             // 無駄な改行を減らす
            $attackResult = false;
        }
        echo "\n";
    }

    
}