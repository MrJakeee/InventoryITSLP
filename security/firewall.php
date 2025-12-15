<?php
// ========================
// INICIAR SESIÓN CORRECTAMENTE
// ========================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $ip = trim($ip_list[0]);
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
// El resto del código se ejecuta con la IP real del visita

$blacklistFile = __DIR__ . '/blacklist.json';
$blacklist = json_decode(@file_get_contents($blacklistFile), true) ?? [];

if (in_array($ip, $blacklist)) {
    http_response_code(403);
    exit("Tu IP ha sido bloqueada: $ip");
}

// ========================
// BLOQUEO POR USER-AGENT VACÍO
// ========================
if (strlen($ua) < 6) {
    http_response_code(403);
    exit('Bad Request');
}

$limite_peticion = 3;
$segundos = 30;
$rateDir = __DIR__ . '/rate_limits/';
$rateFile = $rateDir . md5($ip);

if (!is_dir($rateDir)) {
    mkdir($rateDir, 0777, true);
}

$rateData = json_decode(@file_get_contents($rateFile), true) ?? ['count' => 0, 'time' => 0];

if ($rateData['time'] === 0) {

    $rateData = [
        'count' => 1,
        'time'  => time()
    ];
} else {
    $elapsed = time() - $rateData['time'];

    if ($elapsed < $segundos) {
        $rateData['count']++;

        if ($rateData['count'] > $limite_peticion) {

            $blacklist[] = $ip;
            file_put_contents($blacklistFile, json_encode(array_unique($blacklist), JSON_PRETTY_PRINT));

            http_response_code(403);
            exit('IP bloqueada por exceso de peticiones');
        }
    } else {
        $rateData = [
            'count' => 1,
            'time'  => time()
        ];
    }
}

file_put_contents($rateFile, json_encode($rateData));
