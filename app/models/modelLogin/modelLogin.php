<?php
require_once __DIR__ . '/../../../config/conexion_db.php';

class ModelLogin
{
    public static function validarLogin($usuario, $contrasenia, $sucursal)
    {
        if ($usuario === '' || $contrasenia === '') {
            return ['success' => false, 'error' => "Todos los campos son obligatorios."];
        }

        $db = Database::conectarDB();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE username = :txtusername");
        $stmt->bindParam(':txtusername', $usuario);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($contrasenia, $user['contrasenia'])) {
            $_SESSION['id_usuario'] = $user['id_usuario'];
            $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

            if ($user['tipo_usuario'] === 'administrador') {
                return ['success' => true, 'redirect' => 'admin/informacion'];
            } elseif ($user['tipo_usuario'] === 'inventario') {
                return ['success' => true, 'redirect' => 'inv/informacion'];
            } else {
                if ($sucursal === '') {
                    return ['success' => false, 'error' => "Debes seleccionar una sucursal."];
                }
                $stmt = $db->prepare("SELECT * FROM sucursal WHERE id_sucursal = :id_sucursal");
                $stmt->bindParam(':id_sucursal', $sucursal, PDO::PARAM_INT);
                $stmt->execute();
                $sucursalData = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$sucursalData) {
                    return ['success' => false, 'error' => "Sucursal no válida."];
                }

                $_SESSION['id_sucursal'] = $sucursal;

                // Insertar registro en usuario_sucursal (sin hora_salida)
                $fecha_entrada = date('Y-m-d H:i:s');
                $horario_entrada = date('H:i:s');
                $stmtInsert = $db->prepare("INSERT INTO usuario_sucursal (fecha_entrada, horario_entrada, sucursal_id_sucursal, usuarios_id_usuario)
                VALUES (:fecha_entrada, :horario_entrada, :sucursal_id, :usuario_id)");
                $stmtInsert->bindParam(':fecha_entrada', $fecha_entrada);
                $stmtInsert->bindParam(':horario_entrada', $horario_entrada);
                $stmtInsert->bindParam(':sucursal_id', $sucursal, PDO::PARAM_INT);
                $stmtInsert->bindParam(':usuario_id', $user['id_usuario'], PDO::PARAM_INT);
                $stmtInsert->execute();

                // guardar id_usuario_sucursal en sesión para usarlo luego (evita ambigüedad si tiene varias asignaciones)
                $lastId = (int)$db->lastInsertId();
                if ($lastId > 0) {
                    $_SESSION['id_usuario_sucursal'] = $lastId;
                } else {
                    // fallback: buscar la relación más reciente
                    $stmtUS = $db->prepare("SELECT id_usuario_sucursal FROM usuario_sucursal WHERE usuarios_id_usuario = :usuario AND sucursal_id_sucursal = :sucursal ORDER BY id_usuario_sucursal DESC LIMIT 1");
                    $stmtUS->execute([':usuario' => $user['id_usuario'], ':sucursal' => $sucursal]);
                    $rowUS = $stmtUS->fetch(PDO::FETCH_ASSOC);
                    if ($rowUS) $_SESSION['id_usuario_sucursal'] = (int)$rowUS['id_usuario_sucursal'];
                }

                return ['success' => true, 'redirect' => 'usuario/perfil'];
            }
        } else {
            return ['success' => false, 'error' => "Usuario o contraseña incorrectos."];
        }
    }
}
?>