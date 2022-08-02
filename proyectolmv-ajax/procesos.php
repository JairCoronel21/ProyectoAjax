<?php

// BackEnd (Proceso de lado del Servidor)

// Conexion a la Base de datos *******************************************

include'conexion.php';

$cn = ConexionMysql::Conectarse();

// ************************************************************************


// Procesos CRUD en el Servidor

  if (isset($_POST["action"])) {


    if ($_POST['action'] == "Vista") {

        $tabla = '';
        $tabla .= '<table class="table table-hover" id="tbVista">
                    <thead>
                      <tr>
                        <th>Dni</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Edad</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                      </tr>
                  </thead>
                <tbody>';

        $vista = $cn->prepare('call spVistaDatos();');
        $vista->execute();
        $resultado = $vista->fetchAll();

        foreach ($resultado as $fila) {
          
           $tabla .= '<tr>
                    <td>'.$fila["Dni"].'</td>
                    <td>'.$fila["Nombre"].'</td>
                    <td>'.$fila["Apellidos"].'</td>
                    <td>'.$fila["FechaNacimiento"].'</td>
                    <td>'.$fila["Edad"].'</td>
                    <td>'.$fila["Email"].'</td>
                    <td>
                        <button title="Editar Registro" id="'.$fila["Dni"].'" class="btn btn-warning btn-xs update">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </td>
                    <td>
                        <button title="Eliminar Registro" id="'.$fila["Dni"].'" class="btn btn-danger btn-xs delete">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                 </tr>'; 
        }

        $tabla .= '</tbody></table>';
        echo $tabla;
    }

    
    if ($_POST["action"] == "Insertar") {

        $insertar = $cn->prepare("call spInsertarDatos(:dato1, :dato2, :dato3, :dato4, :dato5, :dato6)");
        $insertar->bindParam(':dato1', $_POST['Dni']);
        $insertar->bindParam(':dato2', $_POST['Nom']);
        $insertar->bindParam(':dato3', $_POST['Ape']);
        $insertar->bindParam(':dato4', $_POST['Fnac']);
        $insertar->bindParam(':dato5', $_POST['Edad']);
        $insertar->bindParam(':dato6', $_POST['Email']);

        
        $rpta = $insertar->execute();

        if ($rpta) {
            echo "Registro insertado";
        }else{
            echo "Error!! No se inserto el Registro";  
        }
    }


    if ($_POST["action"] == "Buscar") {
      
        $buscar = $cn->prepare('call spBuscarDatos(:dato1);');
        $buscar->bindParam(':dato1', $_POST['Dni']);
        $buscar->execute();
        $resultado = $buscar->fetch();
        echo json_encode($resultado);

    }


    if ($_POST["action"] == "Actualizar") {
        $actualizar = $cn->prepare("call spActualizarDatos(:dato1, :dato2, :dato3, :dato4, :dato5, :dato6)");
        $actualizar->bindParam(':dato1', $_POST['Dni']);
        $actualizar->bindParam(':dato2', $_POST['Nom']);
        $actualizar->bindParam(':dato3', $_POST['Ape']);
        $actualizar->bindParam(':dato4', $_POST['Fnac']);
        $actualizar->bindParam(':dato5', $_POST['Edad']);
        $actualizar->bindParam(':dato6', $_POST['Email']);

        $rpta = $actualizar->execute();

        if ($rpta) {
            echo "Registro actualizado";
        }else{
            echo "Error!! No se actualizo el Registro";  
        }
    
    }

    if ($_POST['action']=='Eliminar') {
    
        $eliminar = $cn->prepare("call spEliminarDatos(:dato1)");
        $eliminar->bindParam(':dato1', $_POST['Dni']);

        $rpta = $eliminar->execute();

        if ($rpta) {
            echo "Registro Eliminado";
        }else{
            echo "Error!! No se elimino el Registro";  
        }

    }


  }


?>