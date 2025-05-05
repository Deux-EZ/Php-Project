<?php

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function authenticate($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM login WHERE usuario = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    public function create($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO login (usuario, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);
        return $stmt->execute();
    }

    public function getAllUsers() {
        $result = $this->db->query("SELECT usuario FROM login");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function userExists($username) {
        $stmt = $this->db->prepare("SELECT usuario FROM login WHERE usuario = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function createWithDistributedLog($username, $password) {
        // Iniciar transacciones en ambas bases
        // Obtención de conexiones a ambas bases de datos
        //$db1 es la conexión a la base de datos principal (donde están los usuarios).
        // $db2 es la conexión a la base de datos secundaria (donde se guardan los logs).
        // Usas dos clases distintas (Database y Database2) para manejar conexiones independientes.
        $db1 = Database::getInstance()->getConnection();
        $db2 = Database2::getInstance()->getConnection();
    
        try {
            //Se inicia una transacción en cada base de datos.
            // Esto significa que los cambios hechos después de este punto no serán permanentes hasta que se haga un commit().
            $db1->begin_transaction();
            $db2->begin_transaction();
    
            // Se cifra la contraseña.
            // Se prepara y ejecuta el INSERT del usuario.
            // Si falla, se lanza una excepción y se salta al bloque catch.
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt1 = $db1->prepare("INSERT INTO login (usuario, password) VALUES (?, ?)");
            $stmt1->bind_param("ss", $username, $hashedPassword);
            if (!$stmt1->execute()) {
                throw new Exception("Error al crear usuario: " . $stmt1->error);
            }
    
            // 2. Insertar log en db_transaction
            // Se prepara la información del log.
            // Se ejecuta el INSERT en la base de logs.
            // Si falla, también se lanza una excepción.
            $accion = "Registro de usuario";
            $fecha = date('Y-m-d H:i:s');
            $stmt2 = $db2->prepare("INSERT INTO logs (usuario, accion, fecha) VALUES (?, ?, ?)");
            $stmt2->bind_param("sss", $username, $accion, $fecha);
            if (!$stmt2->execute()) {
                throw new Exception("Error al crear log: " . $stmt2->error);
            }
    
            // Si todo fue bien, commit en ambas
            // Si ambos INSERT fueron exitosos, se confirman los cambios en ambas bases de datos.
            // Los datos quedan guardados de forma permanente.
            $db1->commit();
            $db2->commit();
            return true;
    
        } catch (Exception $e) {
            // Si algo falla, rollback en ambas
            // Si ocurre cualquier error en cualquiera de las operaciones, se revierten los cambios en ambas bases de datos.
            // Así, ninguna base queda con datos inconsistentes.
            // El error se registra en el log del servidor.
            $db1->rollback();
            $db2->rollback();
            error_log($e->getMessage());
            return false;
        }
    }
}