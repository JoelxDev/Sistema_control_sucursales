<?php
// /models/SessionModel.php
require_once __DIR__ . '/../../../config/conexion_db.php';

class SessionModel
{
    public static function obtenerIntentoPorIp(string $ip)
    {
        try {
            $db = Database::conectarDB();
            $sql = "SELECT * FROM intentos_sesiones WHERE ip_intento = :ip LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->execute([':ip' => $ip]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log("SessionModel::obtenerIntentoPorIp: " . $e->getMessage());
            return null;
        }
    }

    public static function incrementarIntentoPorIp(string $ip, string $usuario = '')
    {
        try {
            $db = Database::conectarDB();
            $db->beginTransaction();

            // buscar
            $row = self::obtenerIntentoPorIp($ip);
            if (!$row) {
                $sqlIns = "INSERT INTO intentos_sesiones (usuario_intento, ip_intento, ultimo_intento, intentos_sesion, bloqueo_hasta)
                           VALUES (:usuario, :ip, NOW(), 1, NULL)";
                $stmtIns = $db->prepare($sqlIns);
                $stmtIns->execute([':usuario' => $usuario, ':ip' => $ip]);
                $id = $db->lastInsertId();
                $count = 1;
            } else {
                $sqlUpd = "UPDATE intentos_sesiones
                           SET intentos_sesion = intentos_sesion + 1,
                               ultimo_intento = NOW()
                           WHERE id_intento = :id";
                $stmtUpd = $db->prepare($sqlUpd);
                $stmtUpd->execute([':id' => $row['id_intento']]);
                // leer nuevo valor
                $sqlSel = "SELECT id_intento, intentos_sesion FROM intentos_sesiones WHERE id_intento = :id";
                $stmtSel = $db->prepare($sqlSel);
                $stmtSel->execute([':id' => $row['id_intento']]);
                $r = $stmtSel->fetch(PDO::FETCH_ASSOC);
                $id = $r['id_intento'];
                $count = intval($r['intentos_sesion']);
            }

            $db->commit();
            return ['id' => (int)$id, 'count' => (int)$count];
        } catch (PDOException $e) {
            if ($db && $db->inTransaction()) $db->rollBack();
            error_log("SessionModel::incrementarIntentoPorIp: " . $e->getMessage());
            return ['id' => 0, 'count' => 0];
        }
    }
    public static function resetearIntentosPorIp(string $ip)
    {
        try {
            $db = Database::conectarDB();
            $sql = "UPDATE intentos_sesiones
                    SET intentos_sesion = 0, bloqueo_hasta = NULL, ultimo_intento = NOW()
                    WHERE ip_intento = :ip";
            $stmt = $db->prepare($sql);
            $stmt->execute([':ip' => $ip]);
        } catch (PDOException $e) {
            error_log("SessionModel::resetearIntentosPorIp: " . $e->getMessage());
        }
    }
    // Registrar intento (registro de log: exito = 0/1). userId puede ser null.
   public static function registrarSesionLog(string $usuarioSesion, string $ip, string $agente, int $exito = 0, ?int $userId = null): bool
    {
        try {
            error_log("SessionModel::registrarSesionLog ENTER usuario={$usuarioSesion} ip={$ip} exito={$exito}");
            $db = Database::conectarDB();

            // registrar DB actual (debug)
            try {
                $currentDb = $db->query("SELECT DATABASE()")->fetchColumn();
            } catch (Throwable $_) {
                $currentDb = '(unknown)';
            }
            error_log("SessionModel::registrarSesionLog USING DB: {$currentDb}");

            $sql = "INSERT INTO registro_sesiones (usuario_sesion, ip_sesion, fecha_sesion, agente, exito)
                    VALUES (:usuario, :ip, NOW(), :agente, :exito)";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':usuario', $usuarioSesion, PDO::PARAM_STR);
            $stmt->bindValue(':ip', $ip, PDO::PARAM_STR);
            $stmt->bindValue(':agente', $agente, PDO::PARAM_STR);
            $stmt->bindValue(':exito', (string)$exito, PDO::PARAM_STR);

            $ok = $stmt->execute();
            if ($ok) {
                $lastId = (int)$db->lastInsertId();
                error_log("SessionModel::registrarSesionLog OK id={$lastId}");
                return true;
            } else {
                $err = $stmt->errorInfo();
                error_log("SessionModel::registrarSesionLog FAILED: " . json_encode($err));
                return false;
            }
        } catch (Throwable $e) {
            error_log("SessionModel::registrarSesionLog EXCEPTION: " . $e->getMessage());
            return false;
        }
    }

    // Obtener intento por usuario + ip
    public static function obtenerIntento(string $usuario, string $ip, bool $soloIp = false)
    {
        try {
            $db = Database::conectarDB();
            if ($soloIp) {
                $sql = "SELECT * FROM intentos_sesiones WHERE ip_intento = :ip LIMIT 1";
                $stmt = $db->prepare($sql);
                $stmt->execute([':ip' => $ip]);
            } else {
                $sql = "SELECT * FROM intentos_sesiones WHERE usuario_intento = :usuario AND ip_intento = :ip LIMIT 1";
                $stmt = $db->prepare($sql);
                $stmt->execute([':usuario' => $usuario, ':ip' => $ip]);
            }
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log("SessionModel::obtenerIntento: " . $e->getMessage());
            return null;
        }
    }

    // Crear nuevo intento (primer intento)
    public static function crearIntento(string $usuario, string $ip)
    {
        try {
            $db = Database::conectarDB();
            $sql = "INSERT INTO intentos_sesiones (usuario_intento, ip_intento, ultimo_intento, intentos_sesion, bloqueo_hasta)
                    VALUES (:usuario, :ip, NOW(), 1, NULL)";
            $stmt = $db->prepare($sql);
            $stmt->execute([':usuario' => $usuario, ':ip' => $ip]);
        } catch (PDOException $e) {
            error_log("SessionModel::crearIntento: " . $e->getMessage());
        }
    }

    // Incrementar contador de intentos (por id_intento)
    public static function incrementarIntentoById(int $id): int
    {
        try {
            $db = Database::conectarDB();
            $sql = "UPDATE intentos_sesiones
                    SET intentos_sesion = intentos_sesion + 1,
                        ultimo_intento = NOW()
                    WHERE id_intento = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $id]);

            // obtener el nuevo valor
            $sql2 = "SELECT intentos_sesion FROM intentos_sesiones WHERE id_intento = :id";
            $stmt2 = $db->prepare($sql2);
            $stmt2->execute([':id' => $id]);
            $row = $stmt2->fetch(PDO::FETCH_ASSOC);
            return $row ? intval($row['intentos_sesion']) : 0;
        } catch (PDOException $e) {
            error_log("SessionModel::incrementarIntentoById: " . $e->getMessage());
            return 0;
        }
    }

    // Aplicar bloqueo (por id_intento) por X segundos
    public static function aplicarBloqueoById(int $id, int $seconds)
    {
        try {
            $db = Database::conectarDB();
            $sql = "UPDATE intentos_sesiones
                    SET bloqueo_hasta = DATE_ADD(NOW(), INTERVAL :seg SECOND)
                    WHERE id_intento = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([':seg' => $seconds, ':id' => $id]);
        } catch (PDOException $e) {
            error_log("SessionModel::aplicarBloqueoById: " . $e->getMessage());
        }
    }

    // Resetear intentos (mantiene el registro, resetea contadores)
    public static function resetearIntentos(string $usuario, string $ip)
    {
        try {
            $db = Database::conectarDB();
            $sql = "UPDATE intentos_sesiones
                    SET intentos_sesion = 0, bloqueo_hasta = NULL, ultimo_intento = NOW()
                    WHERE usuario_intento = :usuario AND ip_intento = :ip";
            $stmt = $db->prepare($sql);
            $stmt->execute([':usuario' => $usuario, ':ip' => $ip]);
        } catch (PDOException $e) {
            error_log("SessionModel::resetearIntentos: " . $e->getMessage());
        }
    }

    // Método opcional: eliminar registros muy antiguos (mantenimiento) - no se llama automáticamente aquí
    public static function limpiarRegistrosAntiguos(int $days = 30)
    {
        try {
            $db = Database::conectarDB();
            $sql = "DELETE FROM intentos_sesiones WHERE ultimo_intento < DATE_SUB(NOW(), INTERVAL :days DAY)";
            $stmt = $db->prepare($sql);
            $stmt->execute([':days' => $days]);
        } catch (PDOException $e) {
            error_log("SessionModel::limpiarRegistrosAntiguos: " . $e->getMessage());
        }
    }
}
