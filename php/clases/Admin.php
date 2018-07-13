<?php
require_once 'Conexion.php';
require_once("config.php");

class Admin {
    
    private static $instancia;
    private $dbh;    
    
    /* Contructor de usuario */ 
    private function __construct(){
        try {
            $this->dbh = Conexion::singleton_conexion();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }
    
    /* Singleton para el usuario */ 
    public static function singleton_admin() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    
    /* Obtiene un usuario por id */ 
    public function get_usuario($id) {
        try {
            $query = $this->dbh->prepare('select * from admin WHERE admin.id = :id');
            $query->bindParam(':id', $id);
			$query->execute();
            $this->dbh = null;
			return $query->fetch();
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    /* Comprueba que el token pertenece al id del usuario */ 
    public function comprobarToken($token, $id) {

        $fecha = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
        $fecha = date("Y-m-d", $fecha); 

        try {
            $query = $this->dbh->prepare('select * from admin WHERE admin.id = :id and admin.token = :token and admin.expiracion > :fecha');
            $query->bindParam(':id', $id);
            $query->bindParam(':token', $token);
            $query->bindParam(':fecha', $fecha);
            
			$query->execute();
            $this->dbh = null;
			return $query->fetch();
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    /* Comprueba que el token pertenece al id del usuario */ 
    public function comprobarTokenProyecto($token, $id) {
        $fecha = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
        $fecha = date("Y-m-d", $fecha); 

        try {
            $query = $this->dbh->prepare('select * from proyectos WHERE proyectos.id = :id and proyectos.codigo = :token and proyectos.expiracion > :fecha');
            $query->bindParam(':id', $id);
            $query->bindParam(':token', $token);
            $query->bindParam(':fecha', $fecha);
            
            $query->execute();
            $this->dbh = null;
            return $query->fetch();
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    
    
    /* Registra un usuario */ 
    public function insert_usuario($email){
        try { 
            // Generamos token y fecha de expiracion
            $expiracion = mktime(0, 0, 0, date("m")  , date("d")+2, date("Y"));
            $expiracion = date("Y-m-d", $expiracion); 

            $token = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());
            
            $query = $this->dbh->prepare("INSERT INTO `admin` (`id`, `username`, `email`, `password`, `token`, `expiracion`, `nombre`, `activo`) VALUES (NULL, NULL, :email, NULL, :token, :expiracion, NULL, '0')");
            $query->bindParam(':email', $email);
            $query->bindParam(':token', $token);
            $query->bindParam(':expiracion', $expiracion);
            $query->execute();
            
            $id = $this->dbh->lastInsertId();
            
            $this->enviarMailAlta($token, $email, $id);
            
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    private function enviarMailAlta($token, $email,$id) {
        $destinatario = $email; 
        
        $asunto = MAIL_ASUNTO; 
        
        $cuerpo = MAIL_MESSAGE.' '.MAIL_URL_TOKEN.'index.php?page=registro&token='.$token.'&idUser='.$id;
        
        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
        
        //dirección del remitente 
        $headers .= "From: Gestion de proyectos <".MAIL_FROM.">\r\n"; 
        
        mail($destinatario,$asunto,$cuerpo,$headers) ;
    }
    
    private function enviarMailProyecto($token, $email,$id) {
        $destinatario = $email; 
        
        $asunto = MAIL_ASUNTO_PROYECTO; 
        
        $cuerpo = MAIL_MESSAGE_PROYECTO.' '.MAIL_URL_TOKEN_PROYECTO.'index.php?page=registroProyecto&token='.$token.'&idProyecto='.$id;
        
        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
        
        //dirección del remitente 
        $headers .= "From: Gestion de proyectos <".MAIL_FROM_PROYECTO.">\r\n"; 
        
        mail($destinatario,$asunto,$cuerpo,$headers) ;
    }
    
    /* Actualiza la informacion de un usuario al registrarse */ 
    public function actualiza_usuario($id,$nombre,$password,$usuario){
        $this->dbh = Conexion::singleton_conexion();
        
        $password = md5($password);
        try {
            $query = $this->dbh->prepare('UPDATE `admin` SET `username` = :usuario, `password` = :pass, `nombre` = :nombre, activo = "1" WHERE `admin`.`id` = :id');
            $query->bindParam(':id', $id);
            $query->bindParam(':usuario', $usuario);
            $query->bindParam(':pass', $password);
            $query->bindParam(':nombre', $nombre);
            $query->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    /* Actualiza la informacion de un usuario */ 
    public function update_usuario($id,$nombre,$email,$usuario){
        $this->dbh = Conexion::singleton_conexion();

        try {
            $query = $this->dbh->prepare('update usuario SET nombre = :nombre, usuario = :usuario WHERE id = :id');
            $query->bindParam(':nombre', $nombre);
            $query->bindParam(':usuario', $usuario);
            $query->bindParam(':id', $id);
            $query->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    
    /* Registra un usuario */ 
    public function insert_proyecto($email, $id_convocatoria){
        $this->dbh = Conexion::singleton_conexion();
        $expiracion = mktime(0, 0, 0, date("m")  , date("d")+2, date("Y"));
        $expiracion = date("Y-m-d", $expiracion); 
        $token = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid()); 
        

        try { 
            $query = $this->dbh->prepare("INSERT INTO `proyectos` (`id`, `convocatoria_id`, `email`, `codigo`, `expiracion`, `registrado`, `ciclo`) VALUES (NULL, :id_convocatoria, :email, :token, :expiracion, '0', '')");
            $query->bindParam(':id_convocatoria', $id_convocatoria);
            $query->bindParam(':email', $email);
            $query->bindParam(':token', $token);
            $query->bindParam(':expiracion', $expiracion);
            $query->execute();
            $this->dbh = null;
            
            $this->dbh = Conexion::singleton_conexion();
            $id = $this->dbh->lastInsertId();

            $this->enviarMailProyecto($token, $email, $id);
            $this->insert_fichaProyecto($id);
            
            //Creamos el archivo			   
            $archivo = "upload\dir". $id;
            if (!file_exists($archivo)) {
                mkdir($archivo, 0777, true);
            } 
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    /* Registra un usuario */ 
    private function insert_fichaProyecto($id){
        $this->dbh = Conexion::singleton_conexion();
        
        try { 
            $query = $this->dbh->prepare("INSERT INTO `fichaproyecto` (`id`, `proyecto_id`, `titulo`, `descripcion`, `enlaceinterno`, `enlaceexterno`, `enlacerepositorio`, `codigo`, `fechaPresentacion`, `horaPresentacion`, `logo`, `calificacion`, `comentarios`, `etiquetas`, `activarEdicion`) VALUES (NULL, :id, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '0')");
            $query->bindParam(':id', $id);
            $query->execute();
            $this->dbh = null;
            
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    /* Actualiza la informacion de un usuario */ 
    public function asignar_fecha($id,$fecha,$hora){
        $this->dbh = Conexion::singleton_conexion();
        
        try {
            $query = $this->dbh->prepare('UPDATE `fichaproyecto` SET `fechaPresentacion` = :fecha, `horaPresentacion` = :hora WHERE `fichaproyecto`.`proyecto_id` = :id');
            $query->bindParam(':fecha', $fecha);
            $query->bindParam(':hora', $hora);
            $query->bindParam(':id', $id);
            $query->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    
    
    /* Obtiene los proyectos de la convocatoria que estan activos */ 
    public function get_proyectos_convocatoria($idConvocatoria) {
        $this->dbh = Conexion::singleton_conexion();
        
        try {
            $query = $this->dbh->prepare('SELECT * from fichaproyecto, proyectos where fichaproyecto.proyecto_id = proyectos.id and proyectos.convocatoria_id = :idConvocatoria and proyectos.registrado = 1;');
            $query->bindParam(':idConvocatoria', $idConvocatoria);
            $query->execute();
            $this->dbh = null;
            return $query->fetchAll();
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    /* Obtiene los proyectos de la convocatoria que estan activos */ 
    public function get_proyectos_sinregistrar_convocatoria($idConvocatoria) {
        $this->dbh = Conexion::singleton_conexion();
        
        try {
            $query = $this->dbh->prepare('SELECT * from fichaproyecto, proyectos where fichaproyecto.proyecto_id = proyectos.id and proyectos.convocatoria_id = :idConvocatoria and proyectos.registrado = 0;');
            $query->bindParam(':idConvocatoria', $idConvocatoria);
            $query->execute();
            $this->dbh = null;
            return $query->fetchAll();
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    /* Evita la clonacion de la clase */ 
    public function __clone(){
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }  
}
?>