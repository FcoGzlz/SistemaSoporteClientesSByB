<?php

namespace App\Http\Controllers;
use App\Solicitud;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\SolicitudFormRequest;
use App\User;
use Carbon\Carbon;

class SolicitudController extends Controller
{
    public function SolicitudesClientes(Request $request)
    {
        $busqueda = $request->get('busqueda');
        $separado = explode(" ", $busqueda, 4);

        if (count($separado) > 1)
        {
            // $nombre= "$separado[0] $separado[1]";
            // $apellido= "$separado[2] $separado[3]";

            if (count($separado) == 4) {
                $nombre= "$separado[0] $separado[1]";
                $apellido= "$separado[2] $separado[3]";
                $solicitudesClientes = Solicitud::nombre($nombre)->apellido($apellido)->where('estado', 0)->orderBy('fechaIngreso', 'DESC')->get();
            }
            else
            {
                $solicitudesClientes = Solicitud::nombre($separado[0])->apellido($separado[1])->where('estado', 0)->orderBy('fechaIngreso', 'DESC')->get();
            }

        }
        else
        {
            $solicitudesClientes = Solicitud::busqueda($busqueda)->where('estado', 0)->orderBy('fechaIngreso', 'DESC')->get();
        }


        return view('usuarioAdministrador/solicitudesClientes', compact("solicitudesClientes", 'busqueda'));
    }

    public function definirPrioridad(Request $request){
        $solicitud = Solicitud::findOrFail($request->get('id'));
        $busqueda = "0";
        return view('usuarioAdministrador/ingresarSolicitud', compact("solicitud", "busqueda"));
    }

    public function ingresarSolicitud(Request $request){

        $request->validate(
            [
                'descripcion' => 'required',
                'prioridad'=> 'required',
            ]
            );

        $solicitud = Solicitud::findOrFail($request->get('id'));
        $solicitud->descripcion = $request->get('descripcion');
        $solicitud->prioridad = $request->get('prioridad');
        $solicitud->estado = 1;
        $solicitud->save();
        return redirect()->action('SolicitudController@solicitudesClientes');

    }

    public function SolicitudesIngresadas(Request $request)
    {
        $busqueda = $request->get('busqueda');
        $separado = explode(" ", $busqueda, 4);

        if (count($separado) > 1)
        {

            if (count($separado) == 4) {
                $nombre= "$separado[0] $separado[1]";
                $apellido= "$separado[2] $separado[3]";
                $solicitudesClientes = Solicitud::nombre($nombre)->apellido($apellido)->where('estado', 1)->orderBy('fechaIngreso', 'DESC')->get();
            }
            else
            {
                $solicitudesIngresadas = Solicitud::nombre($separado[0])->apellido($separado[1])->where('estado', 1)->orderBy('fechaIngreso', 'DESC')->get();
            }
        }
        else
        {
            $solicitudesIngresadas = Solicitud::busqueda($busqueda)->where('estado', 1)->orderBy('fechaIngreso', 'DESC')->get();
        }


        return view('usuarioAdministrador/solicitudesIngresadas', compact("solicitudesIngresadas", 'busqueda'));
    }

    public function nuevaSolicitud(){
        $busqueda = "0";
        return view('usuarioAdministrador.agregarSolicitud', compact('busqueda'));
    }


    public function agregarSolicitud(SolicitudFormRequest $request)
    {



        $solicitud = Solicitud::create(
            [
                'rut' => $request->get('rut'),
                'nombreCliente' => $request->get('nombreCliente'),
                'apellidoCliente' => $request->get('apellidoCliente'),
                'telefono' => $request->get('telefono'),
                'tipoOrganizacion' => $request->get('tipoOrganizacion'),
                'nombreOrganizacion' => $request->get('nombreOrganizacion'),
                'direccion' => $request->get('direccion'),
                'descripcion' => $request->get('descripcion'),
                'prioridad' => $request->get('prioridad'),
                'estado' => (1),
            ]

        );
        $solicitud->save();



        return redirect()->action('SolicitudController@solicitudesIngresadas');
    }

    public function detalleSolicitud(Request $request){
        $solicitud = Solicitud::findOrFail($request->get('detalle'));
        $busqueda = "0";
        return view('usuarioAdministrador.prueba', compact("solicitud", "busqueda"));

    }

    public function editarSolicitud(Request $request){
        $solicitud = Solicitud::findOrFail($request->get('id'));
        $busqueda = "0";
        $tecnicosOperativos = User::role('UOperativo')->get();
        return view('usuarioAdministrador.editarSolicitud', compact("solicitud", "busqueda", "tecnicosOperativos"));
    }

    public function guardarSolicitud(SolicitudFormRequest $request){

        $solicitud = Solicitud::findOrFail($request->get('id'));
        $solicitud->rut = $request->get('rut');
        $solicitud->nombreCliente = $request->get('nombreCliente');
        $solicitud->apellidoCliente = $request->get('apellidoCliente');
        $solicitud->telefono = $request->get('telefono');
        $solicitud->tipoOrganizacion = $request->get('tipoOrganizacion');
        $solicitud->nombreOrganizacion = $request->get('nombreOrganizacion');
        $solicitud->direccion = $request->get('direccion');
        $solicitud->descripcion = $request->get('descripcion');
        $solicitud->prioridad = $request->get('prioridad');
        $solicitud->responsable = $request->get('responsable');
        $solicitud->estado = (1);
        $solicitud->save();

        return redirect()->action('SolicitudController@solicitudesIngresadas');
    }

    public function eliminarSolicitud(Request $request){
        $solicitud = Solicitud::findOrFail($request->get('id'));
        $solicitud->delete();
        return redirect()->action('SolicitudController@solicitudesIngresadas');
    }
}
