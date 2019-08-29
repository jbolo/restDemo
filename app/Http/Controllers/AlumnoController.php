<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Alumno;
use Twilio\Rest\Client;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearAlumno(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'nombre' => 'required|max:100',
                    'apellidos' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json(array('description'=>'Invalid transaction'),404);
            
        }
        
        $alumno = new Alumno;
        $alumno->nombre = $request->input('nombre');
        $alumno->apellidos = $request->input('apellidos');
        $alumno->save();

        return response()->json(array('status'=>'0','description'=>'Transaction successful'),200);

    }

    public function notificaAprobacion(Request $request){
        $validator = Validator::make($request->all(), [
                    'nombre' => 'required|max:100',
                    'celular' => 'required',
                    'mensaje' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array('description'=>'Invalid transaction'),404);
            
        }
        
        $sid    = "AC3a7538e093134f8f0ceaa67bb2e14006";
        $token  = "2a554738eb31173eb0eb07862056688f";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
                  ->create("whatsapp:+51".$request->input('celular') , // to
                           array(
                               "from" => "whatsapp:+14155238886",
                               "body" => "Estimado alumno ".$request->input('nombre')." ".$request->input('mensaje')
                           )
                  );


        return response()->json(array('status'=>'0','description'=>'Transaction successful'),200);

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
