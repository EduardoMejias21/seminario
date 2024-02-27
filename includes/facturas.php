<?php
session_start();

require 'conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-sca/le=1.0">
    <title>Comprobante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        table {
            border: black 1px solid;
        }
        tr {
            margin: 15px;
            padding: 15px;
            border: black 1px solid;
        }
        td {
            margin: 15px;
            padding: 15px;
            border: black 1px solid;
        }
        .bor{
            border: black 1px solid;
        }
        .p{
            font-size: 14px;
        }
    </style>
</head>

<body>
    <?php 
    if (isset($_GET['id_venta'])) {
        $id_venta = $_GET['id_venta'];
    
        $sql_venta = "SELECT id_venta, DATE_FORMAT(fecha_venta,'%d-%m-%Y') AS fecha_venta, total_venta,nombre_persona,apellido_persona,cuil_persona,condicion_iva,domicilio_fiscal FROM ventas INNER JOIN personas ON ventas.id_persona = personas.id_persona INNER JOIN clientes ON personas.id_persona = clientes.id_persona WHERE id_venta='$id_venta'";
        $result_venta = mysqli_query($conexion, $sql_venta);
    
        $sql_detalle_venta = "SELECT id_venta,nombre_producto,cantidad_producto, detalle_ventas.precio_unitario,total_x_producto FROM detalle_ventas INNER JOIN productos ON detalle_ventas.id_producto=productos.id_producto WHERE id_venta='$id_venta'";
        $result_detalle_venta = mysqli_query($conexion, $sql_detalle_venta);
    } else {
        header('Location: ../ventas.php');
    }
    ?>
    <div>

        <table>

            <tr class="text-center">
                <th colspan="5">
                    <h3>ORIGINAL</h3>
                </th>
            </tr>
            <?php

            while ($row_venta = mysqli_fetch_assoc($result_venta)) { ?>
             
                <tr>

                <td colspan="3" >
                    <h1 class="text-center">RIXER</h1><br><br>
                    <p  class="p"><b>Razon Social: </b>MEJIAS RAMON EDUARDO</p>
                    <p  class="p"><b>Domicilio Comercial: </b>PJE. JOAQUIN ACUÑA S/N - VALLE VIEJO - CATAMARCA</p>
                    <p  class="p"><b>Condicion frente al IVA: IVA RESPONSABLE INSCRIPTO</b></p>
                </td>
                <td colspan="2">
                    <p class="p"><b>COMPROBANTE DE COMPRA</b></p>
                    <?php echo "<p class='p'><b>Comp Nro: " . $row_venta['id_venta'] . "</b></p>" ?>
                    <?php echo "<p class='p'><b>Fecha de Emision: " . $row_venta['fecha_venta'] . "</b></p>" ?>
                    <p class="p"><b>CUIT: </b>20203087692</p>
                    <p class="p"><b>Ingresos Brutos: </b>33767</p>
                    <p class="p"><b>Fecha de inicio de Act: </b>01/09/2013</p>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <?php echo "<p><b> DNI/CUIL/CUIT: </b>" . $row_venta['cuil_persona'] . "</p>" ?>
                    <?php echo "<p><b> APELLIDO Y NOMBRE/RAZON SOCIAL: </b>" . $row_venta['nombre_persona'] . ' ' . $row_venta['apellido_persona'] . "</p>" ?>
                    <?php echo "<p><b> CONDICION IVA: </b>" . $row_venta['condicion_iva']."</p>" ?>
                    <?php echo "<p><b> DOMICILIO: </b>" . $row_venta['domicilio_fiscal'] . "</p>" ?>
                </td>
            </tr>
                <?php
            } ?>
            

                <tr class="text-center">
                    <th width="3%" class="bor">Cod</th>
                    <th width="40%" class="bor">Descripcion</th>
                    <th width="15%" class="bor">Cantidad</th>
                    <th width="20%" class="bor"> Precio</th>
                    <th width="22%" class="bor">Total</th>
                </tr>
                <?php
                $total = 0;
                while ($row_detalle_venta = mysqli_fetch_assoc($result_detalle_venta)) { ?>
                    <tr class="text-center">
                        <td width="5%"></td>
                        <td width="40%">
                            <?php echo $row_detalle_venta['nombre_producto'] ?>
                        </td>
                        <td width="15%">
                            <?php echo $row_detalle_venta['cantidad_producto'] ?>
                        </td>
                        <td width="20%">$
                            <?php echo $row_detalle_venta['precio_unitario'] ?>
                        </td>
                        <td width="20%">$
                            <?php echo number_format($row_detalle_venta['precio_unitario'] * $row_detalle_venta['cantidad_producto'], 2); ?>
                        </td>
                    </tr>
                    <?php
                    $total = $total + ($row_detalle_venta['precio_unitario'] * $row_detalle_venta['cantidad_producto']);
                } ?>
                <tr>
                    <td colspan="4" align="right">
                        <h4>Total</h4>
                    </td>
                    <td colspan="1" class="text-center">
                        <h4>$
                            <?php echo number_format($total, 2); ?>
                        </h4>
                    </td>
                </tr>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
<?php 
$html=ob_get_clean();
//echo $html;

require_once '../libreria/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=> true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4'); 
//$dompdf->setPaper('A4','landscape'); //forma horizontal

$dompdf->render();

$dompdf->stream("comprobante_de_compra_$id_venta.pdf",array("Attachment" => false)); 
// si ponemos true el pdf se genera y no se descarga con false se abre despues de generarse
?>