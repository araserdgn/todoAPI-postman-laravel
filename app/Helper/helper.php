<?php

if(!function_exists('apiResponse')) {
    function apiResponse($message = null, $status =200, $data =null) {
        return response()->json(['message' => $message, 'data' =>$data],$status);

        //! HTTP mesajlarından 200: Tamam. Standart başarı kodu.
    }
}


//! Helper içine açtık bu fonk. cunku sürekli kullanacağız , eger controller
//! içine açsaydık her controller için tekrar tekrar yazmak gerekblirdi

//  helperi app içerisinde tanımladık fakat bunun calısması için
// composer.json içerisindeki autoload içerisine
//    "files": [
// "app/Helper/helper.php"
// ] ifadesini yapıstırmamız gerekiyor
// Daha sonra composer dump-autoload kodunu yazmamız lazım kii bu dosyayı görsün

