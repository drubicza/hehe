<?php
function curl($p_url,$p_post=null,$p_header=null,$p_proxy=null)
{
    $ch = curl_init();
    $co = array(CURLOPT_URL=>$p_url,
                CURLOPT_RETURNTRANSFER=>true,
                CURLOPT_SSL_VERIFYHOST=>false,
                CURLOPT_SSL_VERIFYPEER=>false,
                CURLOPT_HEADER=>true,
                CURLOPT_TIMEOUT=>30,);

    if ($p_post != "") {
        $co[CURLOPT_POST]       = true;
        $co[CURLOPT_POSTFIELDS] = $p_post;
    }

    if ($p_proxy != "") {
        $co[CURLOPT_HTTPPROXYTUNNEL] = true;
        $co[CURLOPT_PROXYTYPE]       = CURLPROXY_SOCKS4;
        $co[CURLOPT_PROXY]           = $p_proxy;
    }

    if ($p_header != "") {
        $co[CURLOPT_HTTPHEADER] = $p_header;
    }

    curl_setopt_array($ch,$co);
    $c_res = curl_exec($ch);
    curl_close($ch);
    return $c_res;
}

function fetch_value($p_str,$p_start,$p_end)
{
    $i_loc = @strpos($p_str,$p_start);

    if ($i_loc === false) {
        return "";
    }

    $i_len = strlen($p_start);
    $i_end = strpos(substr($p_str,$i_loc + $i_len),$p_end);
    return trim(substr($p_str,$i_loc + $i_len,$i_end));
}

function getcookies($p_src)
{
    preg_match_all("/^Set-Cookie:\s*([^;]*)/mi",$p_src,$p_out);
    $a_cookie = array();

    foreach ($p_out[1] as $s_out) {
        parse_str($s_out,$s_cookie);
        $a_cookie = array_merge($a_cookie,$s_cookie);
    }

    return $a_cookie;
}

function number($i_len)
{
    $s_numb    = "0123456789";
    $i_len     = strlen($s_numb);
    $s_randstr = "";

    for ($i = 0; $i < $i_len; $i++) {
        $s_randstr .= $s_numb[rand(0,$i_len-1)];
    }

    return $s_randstr;
}

function string($i_len)
{
    $s_alphanum = "0123456789abcdefghijklmopqrstuvwxyz";
    $i_len      = strlen($s_alphanum);
    $s_randstr  = "";

    for ($i = 0; $i < $i_len; $i++) {
        $s_randstr .= $s_alphanum[rand(0,$i_len-1)];
    }

    return $s_randstr;
}
?>
