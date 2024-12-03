<?php
function guardarEnSupabase($nombre, $apellido, $email, $password) {
    $url = ""; 
    $apiKey = "";                   

    $data = [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'email' => $email,
        'password' => $password,
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\n" .
                        "apikey: $apiKey\r\n",
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        throw new Exception("Error al guardar en Supabase.");
    }
}
?>
