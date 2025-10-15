<?php
// /services/SecurityService.php

require_once __DIR__ . '/../models/modelLogin/modelLogin.php';
require_once __DIR__ . '/../models/modelLogin/modelSesion.php';

class SecurityService
{
    // Configuración (ajusta según prefieras)
    private const BLOCK_STEP_MINUTES = 30;
    private const MAX_ATTEMPTS = 5;          // intentos permitidos antes de bloquear
    // Nota: puedes implementar bloqueo progresivo si lo deseas

    // Obtener IP del cliente de forma segura (fallbacks)
    public static function getClientIP(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // si hay varias IPs en X-Forwarded-For, tomar la primera
            $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ip = trim($ipList[0]);
        } else {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        }

        // validar formato
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            return '0.0.0.0';
        }
        return $ip;
    }

    // Registrar intento fallido: crea registro si no existe, incrementa y bloquea si llega a MAX_ATTEMPTS
    public static function registrarIntentoFallido(string $usuario, string $ip, string $agente)
    {
        // log fallo
        SessionModel::registrarSesionLog($usuario, $ip, $agente, 0, null);

        // incrementar por IP
        $res = SessionModel::incrementarIntentoPorIp($ip, $usuario);
        $id = $res['id'];
        $count = $res['count'];

        // si excede MAX_ATTEMPTS -> bloqueo incremental
        if ($count > self::MAX_ATTEMPTS && $id > 0) {
            $extra = $count - self::MAX_ATTEMPTS; // 1 para intento 6
            $minutes = $extra * self::BLOCK_STEP_MINUTES;
            $seconds = $minutes * 60;
            SessionModel::aplicarBloqueoById($id, $seconds);
        }
    }

    // Resetear intentos y registrar sesión exitosa
    public static function registrarExitoYReset(string $usuario, string $ip, string $agente, ?int $userId = null)
    {
        // log exito (ahora devuelve bool)
        $ok = SessionModel::registrarSesionLog($usuario, $ip, $agente, 1, $userId);
        // resetear por IP siempre (no condicionamos al ok)
        SessionModel::resetearIntentosPorIp($ip);
        return $ok;
    }

    // Función de ayuda para obtener tiempo restante de bloqueo (si existe)
    public static function estaBloqueado(string $usuario, string $ip): array
    {
        $row = SessionModel::obtenerIntentoPorIp($ip);
        if (!$row) return ['bloqueado' => false, 'until' => null];
        $bloqueoHasta = $row['bloqueo_hasta'] ?? null;
        if ($bloqueoHasta && strtotime($bloqueoHasta) > time()) return ['bloqueado' => true, 'until' => $bloqueoHasta];
        return ['bloqueado' => false, 'until' => null];
    }

    public static function tiempoRestanteBloqueo(string $usuario, string $ip): ?int
    {
        $row = SessionModel::obtenerIntentoPorIp($ip);
        if (!$row || empty($row['bloqueo_hasta'])) return null;
        $until = strtotime($row['bloqueo_hasta']);
        return $until > time() ? ($until - time()) : null;
    }
}
