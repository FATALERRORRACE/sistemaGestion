<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biblousuarios;
use App\Models\Consecutivos;
use Illuminate\Support\Facades\Hash;

class QrController extends Controller
{
    /**
     * Display the form for the resource.
     *
     * Este método se encarga de devolver la vista correspondiente
     * al formulario de la biblioteca.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getForm(Request $request)
    {
        return view('qr');
    }

    /**
     * Set a new resource.
     *
     * Este método está destinado a recibir datos desde una solicitud
     * y realizar algún tipo de acción, como guardar o procesar
     * información relacionada con la biblioteca.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function set(Request $request)
    {
        // Valida los datos requeridos en la solicitud
        $request->validate([
            'biblioteca' => ['required'],
            'carne' => ['required'],
            'codigo' => ['required'],
            'bbltcacceso' => ['required'],
            'localidad' => ['required'],
        ]);

        $consecutivo = Consecutivos::create([
            'Biblioteca' => $request->biblioteca,
            //'impresion' => $request->impresion == 'on' ? 1 : 0,
            'Localidad' => (int)$request->localidad,
            //'carne' => $request->carne,
            //'codigo' => $request->codigo,
            //'inicial' => 0,
            //'v_consecutivo' => 0,
            //'i_consecutivo' => 0,
            'Tipo' => $request->bbltcacceso,
            //'publico_escolar' => $request->publico == 'on' ? 1 : 0
        ]);
        // Retorna una respuesta de éxito o error según el resultado de la creación
        return $consecutivo ?
            [
                'message' => "¡Biblioteca {$request->biblioteca} creada exitosamente!",
                'status' => 'ok',
                'id' => $consecutivo->id,
                'tipo' => $consecutivo->tipo
            ] :
            [
                'message' => 'Error en la consulta',
                'status' => 'error'
            ];
    }

    /**
     * Get a specific resource by its ID.
     *
     * Este método se utiliza para obtener un recurso específico
     * (como un libro o un usuario) de la biblioteca, según su ID.
     *
     * @param int $idBiblioteca ID del recurso a obtener
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get($idBiblioteca, Request $request)
    {
        return Consecutivos::where('Id_Biblioteca', $idBiblioteca)->first();
    }

    /**
     * Update the specified resource.
     *
     * Este método se usa para actualizar los detalles de un recurso
     * (como un libro o un usuario) de la biblioteca basado en su ID.
     *
     * @param int $idBiblioteca ID del recurso a actualizar
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($idBiblioteca, Request $request)
    {

        // Prepara los datos que se actualizarán en la base de datos
        $newData = [
            'Biblioteca' => $request->biblioteca,
            //'impresion' => $request->impresion == 'on' ? 1 : 0,
            //'carne' => $request->carne,
            'Localidad' => (int)$request->localidad,
            //'codigo' => $request->codigo,   
            'Tipo' => $request->bbltcacceso,
            //'publico_escolar' => $request->publico == 'on' ? 1 : 0
        ];

        return Consecutivos::where('Id_Biblioteca', $idBiblioteca)->update($newData) ?
            ['status' => 'ok', 'message' => "¡Biblioteca {$request->biblioteca} actualizada!",
                'id' => $idBiblioteca,
                'tipo' => $request->bbltcacceso
                ] :
            ['status' => 'error', 'message' => "Ocurrió un error"];
    }

    public function getPng(int $id){
        header("Content-Description: File Transfer"); 
        header("Content-Type: application/octet-stream"); 
        header("Content-Disposition: attachment; filename=qrcode{$id}.png"); 

        readfile ("http://afiliacion.biblored.net/afiliacion/admin/qrcodes/{$id}.png");
        exit(); 

    }
    public function getPdf(int $id){
        $data = Consecutivos::where('Id_Biblioteca', $id)->first();
        $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->SetXY(15,15);
        $pdf->SetFont ('helvetica', '', 20 , '', 'default', true );
        $pdf->Write(0, "QR: {$data['Biblioteca']}");
        $pdf->Image("http://afiliacion.biblored.net/afiliacion/admin/qrcodes/{$id}.png", '10', '25', 190, 190);
        $pdf->Output('qrcode{$id}.pdf', 'I');
        

    }
}
