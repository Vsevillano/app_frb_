<?php
require_once 'Conexion.php';

class Login {
    
    private static $instancia;
    private $dbh;
    
    /* Contructor del Login */ 
    private function __construct(){
        try {
            $this->dbh = Conexion::singleton_conexion();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }
    
    /* Singleton del login */ 
    public static function singleton_login() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    
    /* Contructor del Login */ 
	public function loginUsuario($usuario,$password) {
		$datosUsuario = array('Perfil'=>'Invitado');
        $password = md5($password);
        
		try {
            $sql = "SELECT * FROM `frb_users` WHERE usuario = :usuario and password = :pass and activo = '1'";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(":usuario", $usuario);
            $query->bindParam(":pass", $password);
            $query->execute();
            $this->dbh = null;
            
            //si existe el usuario
            if ($query->rowCount() == 1) {
                $fila  = $query->fetch();
                $datosUsuario = array('Perfil'=>$fila['perfil'], 'Usuario'=>$fila['usuario'], 'Nombre'=>$fila['nombre'], 'id'=>$fila['id'], 'Email'=>$fila['email']);
                $logueado = true;
            }
        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();	
        }	
        return $datosUsuario;	
    }
    
    
    // Evita que el objeto se pueda clonar
    public function __clone(){
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }
    
}