<?php

function translations($filePath) {

    if(empty(file_exists($filePath))) return [];

    return json_decode(file_get_contents($filePath));
}

function session_remember(string $key, DateTimeInterface|int $time, callable $callback): mixed {

    $endTime = session($key.'end_time');

    if(now() >= $endTime) {

        $endTime = is_int($time)
            ? now()->addRealSeconds($time)
            : $time;

        session([
            $key => $callback(),
            $key.'end_time' => $endTime
        ]);
    }

    return session($key);
}
