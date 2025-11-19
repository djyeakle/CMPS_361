<?php

    function updateSession(PDO $pdo, string $sessionId, ?int $userId): void {
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? null;

        $sql = "insert into web_sessions(session_id, user_id, ip_address, user_agent)
               values(:session_id, :user_id, :ip, :ua)
               on conflict (session_id) do update
               set last_seen_at = now(),
                  user_id = coalesce(excluded.user_id, web_sessions.user_id)
               ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':session_id' => $sessionId,
            ':user_id' => $userId,
            ':ip' => $ip,
            ':ua' => $ua,
        ]);
    }

    function logPageView(PDO $pdo, string $sessionId, ?int $userId): void {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $referrer = $_SERVER['HTTP_REFERRER'] ?? null;
        $statusCode = http_response_code();

        $sql = "insert into page_views(session_id, user_id, path, http_method, status_code, referrer)
                values(:session_id, :user_id, :path, :method, :status_code, :referrer)
               ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':session_id' => $sessionId,
            ':user_id' => $userId,
            ':path' => $path,
            ':method' => $method,
            ':status_code' => $statusCode,
            ':referrer' => $referrer,
        ]);
    }

?>