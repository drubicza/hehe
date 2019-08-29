<?php
include "deob-curl.php";
define("Uniqueid",string(16));

function fn_login_token($s_phone)
{
    $a_hdr = array(
             "X-Appversion: 3.33.1",
             "X-Uniqueid: ".Uniqueid,
             "X-Platform: Android",
             "X-Appid: com.gojek.app",
             "Accept: application/json",
             "X-Session-Id: 346527b1-73ee-4e8a-bf2b-97b6f18ab9e4",
             "D1: 51:35:12:20:97:58:97:D1:76:21:4A:16:B1:DD:53:E8:6B:7F:82:0E:8C:E9:31:8C:6E:17:C5:8C:EB:7F:7F:35",
             "X-Phonemodel: OPPO,A37f",
             "X-Pushtokentype: FCM",
             "X-Deviceos: Android,5.1.1",
             "User-Uuid: ",
             "X-Devicetoken: fjlOA9ocjOQ:APA91bEwZU6OXIoWzyIKq35k9c7yX8OJZVHbxOhtRhSaOJ-sgDxa2GppI3RqokfYzMvZvYH9cgDrM6a74x5KCNFpWF6q53iu6iIBJvPul7g8hWsYRhmJp9a-ZSzC3IBgaifgO1_QThVY",
             "Authorization: Bearer",
             "Accept-Language: id-ID",
             "X-User-Locale: id_ID",
             "X-Location: 31.24916,121.4878983",
             "X-Location-Accuracy: 3.9",
             "X-M1: 1:__4d102b720e0b4c2f8ac6a6c697bff417,2:48331203,3:1559436825749-3935752393102334594,4:9434,5:|2400|2,6:UNKNOWN,7:\"jrtq051350\",8:720x1280,9:passive,gps,10:0,11:UNKNOWN",
             "Content-Type: application/json; charset=UTF-8",
             "Host: api.gojekapi.com",
             "User-Agent: okhttp/3.12.1",);
    $c_res = curl("https://api.gojekapi.com/v4/customers/login_with_phone",'{"phone":"+62'.$s_phone.'"}',$a_hdr);

    if (strpos($c_res,"Kode verifikasi sudah dikirim ke")) {
        $s_token = fetch_value($c_res,'"login_token": "','"');
    } else {
        $s_token = "failed";
    }

    return $s_token;
}

function fn_access_token($s_otp,$p_auth)
{
    $a_hdr = array(
             "X-Appversion: 3.33.1",
             "X-Uniqueid: ".Uniqueid,
             "X-Platform: Android",
             "X-Appid: com.gojek.app",
             "Accept: application/json",
             "X-Session-Id: 346527b1-73ee-4e8a-bf2b-97b6f18ab9e4",
             "D1: 51:35:12:20:97:58:97:D1:76:21:4A:16:B1:DD:53:E8:6B:7F:82:0E:8C:E9:31:8C:6E:17:C5:8C:EB:7F:7F:35",
             "X-Phonemodel: OPPO,A37f",
             "X-Pushtokentype: FCM",
             "X-Deviceos: Android,5.1.1",
             "User-Uuid: ",
             "X-Devicetoken: fjlOA9ocjOQ:APA91bEwZU6OXIoWzyIKq35k9c7yX8OJZVHbxOhtRhSaOJ-sgDxa2GppI3RqokfYzMvZvYH9cgDrM6a74x5KCNFpWF6q53iu6iIBJvPul7g8hWsYRhmJp9a-ZSzC3IBgaifgO1_QThVY",
             "Authorization: Bearer",
             "Accept-Language: id-ID",
             "X-User-Locale: id_ID",
             "X-Location: 31.24916,121.4878983",
             "X-Location-Accuracy: 3.9",
             "X-M1: 1:__4d102b720e0b4c2f8ac6a6c697bff417,2:48331203,3:1559436825749-3935752393102334594,4:9434,5:|2400|2,6:UNKNOWN,7:\"jrtq051350\",8:720x1280,9:passive,gps,10:0,11:UNKNOWN",
             "Content-Type: application/json; charset=UTF-8",
             "Host: api.gojekapi.com",
             "User-Agent: okhttp/3.12.1",);
    $c_res = curl("https://api.gojekapi.com/v4/customers/login/verify",'{"client_name":"gojek:cons:android","client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e","data":{"otp":"'.$s_otp.'","otp_token":"'.$p_auth.'"},"grant_type":"otp","scopes":"gojek:customer:transaction gojek:customer:readonly"}',$a_hdr);

    if (strpos($c_res,'"success": true')) {
        $s_token = fetch_value($c_res,'"access_token": "','"');
    } else {
        $s_token = "failed";
    }

    return $s_token;
}

function fn_voucher_code($p_voucher_id,$p_auth)
{
    $a_hdr = array(
             "X-Appversion: 3.33.1",
             "X-Uniqueid: ".Uniqueid,
             "X-Platform: Android",
             "X-Appid: com.gojek.app",
             "Accept: application/json",
             "X-Session-Id: 346527b1-73ee-4e8a-bf2b-97b6f18ab9e4",
             "D1: 51:35:12:20:97:58:97:D1:76:21:4A:16:B1:DD:53:E8:6B:7F:82:0E:8C:E9:31:8C:6E:17:C5:8C:EB:7F:7F:35",
             "X-Phonemodel: OPPO,A37f",
             "X-Pushtokentype: FCM",
             "X-Deviceos: Android,5.1.1",
             "User-Uuid: ",
             "X-Devicetoken: fjlOA9ocjOQ:APA91bEwZU6OXIoWzyIKq35k9c7yX8OJZVHbxOhtRhSaOJ-sgDxa2GppI3RqokfYzMvZvYH9cgDrM6a74x5KCNFpWF6q53iu6iIBJvPul7g8hWsYRhmJp9a-ZSzC3IBgaifgO1_QThVY",
             "Authorization: Bearer ".$p_auth,
             "Accept-Language: id-ID",
             "X-User-Locale: id_ID",
             "X-Location: 31.24916,121.4878983",
             "X-Location-Accuracy: 3.9",
             "X-M1: 1:__4d102b720e0b4c2f8ac6a6c697bff417,2:48331203,3:1559436825749-3935752393102334594,4:9434,5:|2400|2,6:UNKNOWN,7:\"jrtq051350\",8:720x1280,9:passive,gps,10:0,11:UNKNOWN",
             "Content-Type: application/json; charset=UTF-8",
             "Host: api.gojekapi.com",
             "User-Agent: okhttp/3.12.1",);
    $c_res = curl("https://api.gojekapi.com/gopoints/v1/orders",'{"gopay_pin":"","payment_type":"points","voucher_batch_id":"'.$p_voucher_id.'","voucher_count":0}',$a_hdr);

    if (stripos($c_res,'"success":true')) {
        preg_match('/"data":{"voucher_codes":(.*?)}/',$c_res,$s_match);
        echo "[!] Success | ".$s_match[1]."\n";
    } else {
        echo "[!] Failed\n";
    }
}

function fn_start()
{
    echo "[#] Phone number : ";
    $s_phone = trim(fgets(STDIN));

    if ($s_phone != "") {
        $s_login_token = fn_login_token($s_phone);

        if ($s_login_token == "failed") {
            echo "[!] Something wrong\n";
        } else {
            echo "[!] Otp code sent to ".$s_phone."\n";
            echo "[#] Insert your otp code : ";
            $s_otp = trim(fgets(STDIN));

            if ($s_otp == "failed") {
                echo "[!] Something wrong with your otp code\n";
            } else {
                $s_access_token = fn_access_token($s_otp,$s_login_token);

                if ($s_access_token == "failed") {
                    echo "[!] Failed\n";
                } else {
                    echo "\n[*] List voucher \n";
                    echo "[1] 10 Voucher GoBills Cashback 70%\n";
                    echo "[#] Select : ";
                    $s_input = trim(fgets(STDIN));
                    echo "\n";

                    if ($s_input == "1") {
                        echo "GoBills Cashback 70%\n";

                        for ($i = 0; $i < 1; $i++) {
                            fn_voucher_code("a877fb0d-f237-498a-ae45-66e355f2ca2a",$s_access_token);
                        }
                    }
                }
            }
        }
    }
}

fn_start();

while (true) {
    echo "\nWanna try again? (y/n): ";
    $s_input = trim(fgets(STDIN));

    if ($s_input == "y") {
        echo "\n";
        fn_start();
    } else {
        die("Done!\n");
    }
}
?>
