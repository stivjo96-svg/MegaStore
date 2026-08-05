<?php

require_once __DIR__ . '/fpdf.php';
require_once __DIR__ . '/../config/conexion.php';

class FacturaPDF extends FPDF
{

    private $conexion;

    public function __construct()
    {
        parent::__construct();

        $database = new Conexion();

        $this->conexion = $database->conectar();
    }

    public function generar($pedido_id)
    {

        $sql = "SELECT
                    p.*,
                    u.nombres,
                    u.apellidos,
                    u.email,
                    u.telefono,
                    u.direccion
                FROM pedidos p
                INNER JOIN usuarios u
                    ON p.usuario_id = u.id
                WHERE p.id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id',$pedido_id);

        $stmt->execute();

        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$pedido){

            die("Pedido no encontrado");

        }

        $sqlDetalle = "SELECT

                            dp.*,

                            pr.nombre

                        FROM detalle_pedidos dp

                        INNER JOIN productos pr

                            ON dp.producto_id = pr.id

                        WHERE dp.pedido_id=:id";

        $stmtDetalle = $this->conexion->prepare($sqlDetalle);

        $stmtDetalle->bindParam(':id',$pedido_id);

        $stmtDetalle->execute();

        $detalle = $stmtDetalle->fetchAll(PDO::FETCH_ASSOC);

        /*
        =====================================
        DESDE AQUI EMPIEZA EL PDF
        =====================================
        */

        $this->AddPage();

        $this->SetFont('Arial','B',18);

        $this->Cell(190,10,utf8_decode("MEGAFERRE"),0,1,'C');

        $this->SetFont('Arial','',11);

        $this->Cell(190,8,utf8_decode("FACTURA DE VENTA"),0,1,'C');

        $this->Ln(5);

        $this->SetFont('Arial','',10);

        $this->Cell(35,7,"Codigo:",0);

        $this->Cell(60,7,$pedido['codigo'],0);

        $this->Cell(25,7,"Fecha:",0);

        $this->Cell(50,7,$pedido['fecha'],0);

        $this->Ln();

        $this->Cell(35,7,"Cliente:",0);

        $this->Cell(

            120,

            7,

            utf8_decode(

                $pedido['nombres']." ".$pedido['apellidos']

            ),

            0

        );

        $this->Ln();

        $this->Cell(35,7,"Correo:",0);

        $this->Cell(

            120,

            7,

            $pedido['email'],

            0

        );

        $this->Ln();

        $this->Cell(35,7,"Telefono:",0);

        $this->Cell(

            120,

            7,

            $pedido['telefono'],

            0

        );

        $this->Ln();

        $this->Cell(35,7,"Direccion:",0);

        $this->Cell(

            120,

            7,

            utf8_decode($pedido['direccion']),

            0

        );

        $this->Ln(12);

                /*
        =====================================
        TABLA DE PRODUCTOS
        =====================================
        */

        $this->SetFillColor(230,230,230);

        $this->SetFont('Arial','B',10);

        $this->Cell(80,8,'Producto',1,0,'C',true);

        $this->Cell(25,8,'Cantidad',1,0,'C',true);

        $this->Cell(40,8,'Precio',1,0,'C',true);

        $this->Cell(45,8,'Subtotal',1,1,'C',true);

        $this->SetFont('Arial','',10);

        foreach($detalle as $item){

            $this->Cell(

                80,

                8,

                utf8_decode($item['nombre']),

                1

            );

            $this->Cell(

                25,

                8,

                $item['cantidad'],

                1,

                0,

                'C'

            );

            $this->Cell(

                40,

                8,

                "$ ".number_format($item['precio'],2),

                1,

                0,

                'R'

            );

            $this->Cell(

                45,

                8,

                "$ ".number_format($item['subtotal'],2),

                1,

                1,

                'R'

            );

        }

        $this->Ln(8);

        /*
        =====================================
        TOTALES
        =====================================
        */

        $this->SetFont('Arial','B',10);

        $this->Cell(145);

        $this->Cell(25,8,'Subtotal',0);

        $this->Cell(

            20,

            8,

            "$ ".number_format($pedido['subtotal'],2),

            0,

            1,

            'R'

        );

        $this->Cell(145);

        $this->Cell(25,8,'IVA',0);

        $this->Cell(

            20,

            8,

            "$ ".number_format($pedido['iva'],2),

            0,

            1,

            'R'

        );

        $this->SetFont('Arial','B',12);

        $this->Cell(145);

        $this->Cell(25,10,'TOTAL',0);

        $this->Cell(

            20,

            10,

            "$ ".number_format($pedido['total'],2),

            0,

            1,

            'R'

        );

        $this->Ln(10);

        $this->SetFont('Arial','I',10);

        $this->Cell(

            190,

            8,

            utf8_decode("Gracias por comprar en MegaFerre."),

            0,

            1,

            'C'

        );

        $archivo = __DIR__ . '/../facturas/' . $pedido['codigo'] . '.pdf';

        $this->Output('F', $archivo);

        return $archivo;
    }

}