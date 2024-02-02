<?php

use Illuminate\Support\Facades\Storage;

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


// Klasör olusturm kodu resimler için
// if (!function_exists('createFolder')) {
//     $storageDisk = config('filesystems.php');

//     if($storageDisk === 's3') { //AMAZON SUNUCUSU İÇİN
//         Storage::disk('s3')->put($folderPath.'/', '');
//     }
//     else { // amazon değil ise de localde calısacak bu
//         if(!file_exists($folderPath)) {
//             mkdir($folderPath,077,true);
//         }
//     }
// }


// Amazon'da image kaydetme fonk.

// if(!function_exists('uploadToS3')) {
//     function uploadToS3($image,$directory,$filename) {
//         $imagePath = Storage::disk('s3')->put($directory,$image,$filename);
//         return Storage::disk('s3')->url($imagePath);
//     }
// }

// resmi taşıyan fonksiyon
// if(!function_exists('uploadToLocal')) {
//     function uploadtoLocal($image,$filePath,$fileName) {
//         $image->move(public_path($filePath),$fileName);
//         return $filePath.$fileName;
//     }
// }

// resimleri jpg'den webp çeviren yapı, optimize için önemlidir

// if(!function_exists('uploadWebp')) {
//     function uploadWebp($image,$filePath,$fileName) {
//         $image = ImageUpload::make($image);
//         $image->encode('webp',75);
//         $image->save(public_path($filePath.$fileName.'.webp'));
//         return $filePath.$fileName.'.webp';

//     }
// }

// Resim yükleyen kod

// if(!function_exists('uploadImage')) {
//     function uploadImage($image,$fileName,$filePath) {
//         createFolder($filePath);
//         $text = $image->getClientOriginalExtension();
//         $fileFulName = time().'-'.$image->getClientOriginalName();
//         $storageDisk = config('filesystems.default');

//         if(!in_array($text, ['pdf','svg','jiff','webp'])) {
//             if($storageDisk === 's3') {
//                 $imagePath = uploadToS3($image,'img',$fileFulName);
//             }
//             else {
//                 $imagePath = uploadToLocal($image,$filePath,$fileFulName);
//             }
//         }
//         else {
//             if($storageDisk ==='s3') {
//                 $imagePath = uploadToS3($image,'img',$fileFulName);
//             }
//             else {
//                 $imagePath = uploadWebp($image,$filePath,$fileFulName);
//             }
//         }
//         return $imagePath;
//     }
// }

// // Resim silme kodları

// if(!function_exists('removeImage')) {
//     function removeImage($image) {
//         $storageDisk = config('filesystems.default');

//         if($storageDisk === 's3') {
//             $imagePath = str_replace(Storage::disk('s3')->url('/'),'',$image);
//             Storage::disk('s3')->delete($imagePath);
//         }
//         else {
//             $imagePath = str_replace(env('APP_URL'),'',$image);
//             if (file_exists($imagePath)) {
//                 unlink($imagePath);
//             }
//         }
//     }
// }
