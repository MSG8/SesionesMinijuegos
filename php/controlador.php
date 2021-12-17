<?php
    /**
     * Controlador de la aplicacion, se encarga de dirigir los procesos
     */
    class Controlador
    {
        public $operaciones; //Declaro clase operaciones, encargada de las operaciones con la base de datos, es el modelo de datos
        public $vista; //Declaro clase vista, encargada de la parte visual del programa
        function __construct()
        {
            require 'operacionesBd.php'; //llamamos a los parametros para la conexion
            $this->operaciones = new Operaciones();
            require 'vista.php'; //llamamos a los parametros para la conexion
            $this->vista = new Vista();
        }
        /**
         * Metodo encargado de redireccionar la pagina web a la vista 
         * Tambien controla la existencia de antiguas sesion para eliminarlas
         */
        public function sesion()
        {
            if (isset($_SESSION['correo'])) 
            {
                session_destroy();
            }
            if (isset($_GET['op'])) 
            {
               switch ($_GET['op']) 
               {
                   case 'Crear':
                        $this->crearUsuario($_POST);
                       break;
                   default:
                        $this->verificarUsuario();
                       break;
               }
            }
            else 
            {
                $this->verificarUsuario();
            }
        }
        /**
         * Metodo encargado de verificar si existe la contraseña para ese correo dado
         */
        public function verificarUsuario()
        {
            if (isset($_POST['entrar']) && $this->operaciones->buscarUsuario($_POST['correo'])->fetch_assoc() && ($_POST['constrasenia'] == $this->operaciones->buscarUsuario($_POST['correo'])->fetch_assoc()['contrasenia'])) 
            {
                session_start();
                $_SESSION['correo'] = $_POST['correo'];
                $this->vista->perfil($this->operaciones->verPreferenca($_SESSION['correo']));
            }
            else 
            {
                if (isset($_POST['entrar'])) 
                {
                    // $error = $this->operaciones->numeroError();
                    // echo $this->operaciones->informacionError();
                    // echo $error;
                    if (!$this->operaciones->buscarUsuario($_POST['correo'])->fetch_assoc()) 
                    {
                        $this->vista->alerta('Correo incorrecto o no creo aun su cuenta');
                    }
                    else
                    {
                        if ($_POST['constrasenia'] != $this->operaciones->buscarUsuario($_POST['correo'])->fetch_assoc()['contrasenia']) 
                        {
                            $this->vista->alerta('Su contraseña es incorrecta');
                        }
                    }
                }
                $this->vista->formularioEntrar();
            }
        }
        /**
         * Metodo encargado de crear un usuario nuevo y sus preferencias
         */
        public function crearUsuario($formulario)
        {
            if (isset($_POST['crear']) && $this->operaciones->agregarUsuario($formulario) && ($_POST['constrasenia'] == $_POST['constrasenia2'])) 
            {
                if (isset($_POST['preferencia'])) 
                {
                    $this->operaciones->guardarPreferencias($_POST);
                }
                header('Location: ?op=Inicio');
            }
            else 
            {
                if (isset($_POST['crear'])) 
                {
                    $error = $this->operaciones->numeroError();
                    // echo $this->operaciones->informacionError();
                    // echo $error;
                    if ($_POST['constrasenia'] != $_POST['constrasenia2']) 
                    {
                        $this->vista->alerta('Su primera contraseña no corresponde con la  repeticion de contraseña');
                    }
                    if ($error == 1062) 
                    {
                        $this->vista->alerta('Correo ya registrado, ya tiene una cuenta');
                    }
                }
                //$this->vista->formularioCrear($this->operaciones->minijuegos());
                $this->vista->formularioCrearDos($this->operaciones->minijuegos());
            }
        }
    }
?>