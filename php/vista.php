<?php
    
    /**
     * Clase destinada a visualizar nuestra aplicacion
     */
    class Vista
    {
        /**
         * Metodo encargado a mostrar el formulario de iniciar sesion
         */
        public function formularioEntrar()
        {
            echo
                '<form action="" method="post">
                    <h2> ENTRAR </h2>
                    <div>
                        <label for="correo">
                            CORREO
                        </label>';
            if (isset($_POST['correo'])) 
            {
                
                echo '<input value="'.$_POST['correo'].'" type="email" name="correo" placeholder="nombre@fundacionloyola.net" pattern="^.+@.*fundacionloyola\..+$" required="required"/>';
            }
            else
            {
                echo '<input value="" type="email" name="correo" placeholder="nombre@fundacionloyola.net" pattern="^.+@.*fundacionloyola\..+$" required="required"/>';
            }
            echo    '</div>
                    <div>
                        <label for="constrasenia">
                            CONSTRASEÑA
                        </label>
                        <input type="password" name="constrasenia" placeholder="coloque contraseña" required="required"/>
                    </div>
                    <input value="ENTRAR" type="submit" name="entrar" />
                    <a href="?op=Crear"> Crear cuenta </a>
                </form>'
            ;
        }
        /**
         * Metodo encargado a mostrar el formulario para crear un usuario nuevo y las preferencias(SELECT)
         */
        public function formularioCrear($minijuegos)
        {
            echo
                '<form action="" method="post">
                    <h2> CREAR </h2>
                    <div>
                        <label for="correo">
                            CORREO
                        </label>';
            $this->recordarCorreo();
            echo        '<input type="email" name="correo" value="" pattern="^.+@.*fundacionloyola\..+$" placeholder="nombre@fundacionloyola.net" required="required" />
                    </div>
                    <div>
                        <label for="constrasenia">
                            CONSTRASEÑA
                        </label>
                        <input type="password" name="constrasenia" value="" placeholder="se recomienta numeros y letras" required="required"/>
                    </div>
                    <div>
                        <label for="constrasenia2">
                            REPITA CONTRASEÑA
                        </label>
                        <input type="password" name="constrasenia2" value="" placeholder="coloque la misma contraseña" required="required"/>
                    </div>
                    <div>
                        <label for="preferencia">
                            PREFERENCIAS
                        </label>';
                if (isset($minijuegos)) 
                {
                    echo '<select name="preferencia[]" multiple="multiple">';
                    echo '<option value="null" selected="selected" hidden="hidden"> SELECCIONA PREFERENCIAS </option>';
                    while ($fila = $minijuegos->fetch_assoc()) 
                    {
                        echo '<option value='.$fila["idMinijuego"].'> '.$fila["nombre"].' </option>';
                    }
                    echo '</select>';
                }
                echo 
                    '</div>
                    <input value="CREAR" type="submit" name="crear" />
                    <a href="?op=Iniciar"> Iniciar sesion </a>
                </form>'
            ;
        }
        /**
         * Metodo encargado a mostrar el formulario para crear un usuario nuevo y las preferencias(CHECKBOX)
         */
        public function formularioCrearDos($minijuegos)
        {
            echo
                '<form action="" method="post">
                    <h2> CREAR </h2>
                    <div>
                        <label for="correo">
                            CORREO
                        </label>';
            $this->recordarCorreo();
            echo    '</div>
                    <div>
                        <label for="constrasenia">
                            CONSTRASEÑA
                        </label>
                        <input type="password" name="constrasenia" value="" placeholder="se recomienta numeros y letras" required="required"/>
                    </div>
                    <div>
                        <label for="constrasenia2">
                            REPITA CONTRASEÑA
                        </label>
                        <input type="password" name="constrasenia2" value="" placeholder="coloque la misma contraseña" required="required"/>
                    </div>
                    <div>
                        <label for="preferencia">
                            PREFERENCIAS
                        </label>';
                if (isset($minijuegos)) 
                {
                    while ($fila = $minijuegos->fetch_assoc()) 
                    {
                        echo 
                            '
                            <div>
                                <input type="checkbox" name="preferencia[]" value='.$fila["idMinijuego"].' />
                                <label for="preferencia[]">
                                    '.$fila["nombre"].' 
                                </label>
                            </div>'
                        ;
                    }
                    echo '</select>';
                }
                echo 
                    '</div>
                    <input value="CREAR" type="submit" name="crear" />
                    <a href="?op=Iniciar"> Iniciar sesion </a>
                </form>'
            ;
        }
        /**
         * Metodo encargado de mostrar que el usuario ha entrado en la web
         */
        public function perfil($preferencias)
        {
            echo
                '
                <div id="entrado">
                    <p> BIENVENIDO A NUESTRA WEB </p>
                    <p> YA ESTAS REGISTRADO DON/DOÑA '.$_SESSION["correo"].' con nombre de sesion: '.session_name().' y id de sesion de: '.session_id().' </p>
                </div>'
                ;

            if (isset($preferencias)) 
            {
                echo
                    '<div id="preferencias">
                        <h3> Preferencias Seleccionadas </h3>';
                while ($fila = $preferencias->fetch_assoc()) 
                {
                    echo '<p> '.$fila["nombre"].' </p>';
                }
                echo '</div>';
            }
                
            echo'<a href="?op=Inicio"> Cambiar cuenta </a>' ;
        }
        /**
         * Metodo encargado de mostrar un aviso de los errores
         */
        public function alerta($frase)
        {
            echo
                '
                <div class="alerta">
                    <p> '.$frase.'</p>
                </div>
                '
            ;
        }
        public function recordarCorreo()
        {
            if (isset($_POST['correo'])) 
            {
                
                echo '<input value="'.$_POST['correo'].'" type="email" name="correo" placeholder="nombre@fundacionloyola.net" pattern="^.+@.*fundacionloyola\..+$" required="required"/>';
            }
            else
            {
                echo '<input value="" type="email" name="correo" placeholder="nombre@fundacionloyola.net" pattern="^.+@.*fundacionloyola\..+$" required="required"/>';
            }
        }
    }
?>