<?php
  /**
   * Esta clase se usara para emplear los metodos necesarios en un crud: buscamos, eleminamos, modificamos, añadimos y vemos una lista
   */
  class Operaciones
  {
    public $conexion;
    public $resultado;

    function __construct()
    {
      require 'config.php'; //llamamos a los parametros para la conexion
      $this->conexion = new mysqli(SERVIDOR, USUARIO, CONTRASENIA, BASEDATOS);
    }

    public function hacerConsulta($consulta) //metodo usado por si se modifica el objeto que trabaja con bases de datos
    {
      return $this->conexion->query($consulta);
    }

    public function usuarios() //metodo para sacar un array de todos los usuarios
    {
      $consulta = "SELECT * FROM usuarios;";
      $this->resultado= $this->hacerConsulta($consulta); //Enviamos la consulta al metodo query del objeto conexion (mysqli) y devolvera el array con la fila pedida
      return $this->resultado;
    }

    public function buscarUsuario($correo) //metodo para la fila correspondiente al correo dado
    {
      $consulta = "SELECT * FROM usuarios WHERE correo = '".$correo."';";
      $this->resultado= $this->hacerConsulta($consulta); //Enviamos la consulta al metodo query del objeto conexion (mysqli) y devolvera el array con la fila pedida
      return $this->resultado;
    }

    public function minijuegos() //metodo para sacar un array de todos los minijuegos
    {
      $consulta = "SELECT * FROM minijuegos;";
      $this->resultado= $this->hacerConsulta($consulta); //Enviamos la consulta al metodo query del objeto conexion (mysqli) y devolvera el array con la fila pedida
      return $this->resultado;
    }

    public function agregarUsuario($formulario) //metodo para sacar un array de todos los minijuegos
    {
      $consulta = "INSERT INTO Usuarios(correo, contrasenia) VALUES ('".$formulario['correo']."', '".$formulario['constrasenia']."');";
      $this->resultado= $this->hacerConsulta($consulta); //Enviamos la consulta al metodo query del objeto conexion (mysqli) y devolvera el array con la fila pedida
      return $this->resultado;
    }

    public function guardarPreferencias($formulario) //metodo para sacar un array de todos los minijuegos
    {
      for ($indice=0; $indice < count($formulario['preferencia']); $indice++) 
      { 
        $consulta = "INSERT INTO Preferencia VALUES ((SELECT idUsuario FROM Usuarios WHERE correo = '".$formulario['correo']."'), ".$formulario['preferencia'][$indice].");";
        echo $consulta;
        $this->resultado= $this->hacerConsulta($consulta); //Enviamos la consulta al metodo query del objeto conexion (mysqli) y devolvera el array con la fila pedida
      }
      return $this->resultado;
    }

    public function verPreferenca($correo) //metodo para sacar las preferencias
    {
      $consulta = "SELECT * FROM preferencia p INNER JOIN minijuegos m ON p.idMinijuego = m.idMinijuego AND p.idUsuario = (SELECT idUsuario FROM usuarios WHERE correo = '".$correo."');";
      $this->resultado= $this->hacerConsulta($consulta); //Enviamos la consulta al metodo query del objeto conexion (mysqli) y devolvera el array con la fila pedida
      return $this->resultado;
    }

    public function vaciar($valor) //Metodo para colocar si algun cambio esta vacio, como null
    {
      if (empty($valor)) 
      {
        return 'null'; // envio una concatenacion poruqe si no no lo entiende php
      }
      else
      {
        return "'".$valor."'";//si el valor es diferente a vacio pues introduce el valor que metimos por formulario
      }
    }
    
    public function informacionError() //La llamamos para ver una descripcion del error de la consulta
    {
      return $this->conexion->error;
    }

    public function numeroError() //La llamamos para ver el numero de error correspondiente por la consulta
    {
      return $this->conexion->errno;
    }

    public function filasResultado() //La llamamos para ver el numero de filas del resultado
    {
      return $this->resultado->num_rows;
    }

    public function cerrar() //La llamamos para cerrar la conexion con la  base de datos
    {
      $this->conexion->close();
    }
  }

?>
