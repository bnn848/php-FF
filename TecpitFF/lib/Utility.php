<?php

/* 終了条件の判定メソッドを定義 */
function isFinish($objects) {
    
    $deathCount = 0;
    foreach($objects as $object) {
        if($object->getHitPoint() > 0) {
            return false;
        }
        $deathCount++;
    }
    if($deathCount === count($objects)) {
        return true;
    }
    
}
