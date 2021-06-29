<?php

class Loader {
    
    // Load対象ディレクトリを登録するための配列
    private $directories = array();
    
    // 指定したディレクトリパスを上記$directoriesに格納する
    public function regDirectory($dir) { // 引数にパス名を受け取る
        $this->directories[] = $dir; // 受け取ったパス名を配列に格納する
        return;
    }
    
    // 読み込み処理
    public function register() {
    //  spl = Standard PHP Library (標準装備された構文)
    //  spl_autoload_register(array(インスタンス, コールバック関数));
        spl_autoload_register(array($this, 'loadClass'));
    }
    
    // 自動で呼び出されるコールバック関数
    public function loadClass($className) { // クラス名を受け取る
        foreach($this->directories as $dir) { // 配列から一つずつパス名を取り出す
            $filePath = $dir . "/" . $className . '.php'; // ファイル名に還元する
        }
        
        // 還元したファイル名が読み込めるかチェックする
        if(is_readable($filePath)) { // is_readable() : 組込メソッドで読み込み可能ならtrue
            require $filePath;  // 読み込めたらrequireする
            return;
        }
    }
}