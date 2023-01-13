<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Grupo;
use App\Models\Inscripcione;
use App\Models\Modulo;
use App\Models\Calificacione;
use App\Models\Planestudio;
use App\Models\User;
use App\Models\Adeudo;
use App\Models\Cardex;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;


class Inscripcion extends Component
{

    //Validaciones para inscripcion
    protected $rules = [
        'inscribiendo.folio' => 'required|integer|min:1',
        'inscribiendo.cantidad' => 'required|numeric|min:0',
        'inscribiendo.idGrupo' => 'required|integer|min:1',
    ];

    protected $messages = [
        'inscribiendo.folio.required' => 'El campo folio es obligatorio',
        'inscribiendo.folio.integer' => 'El campo folio debe ser un numero entero',
        'inscribiendo.folio.min' => 'El campo folio no es válido',
        'inscribiendo.cantidad.required' => 'El campo cantidad es obligatorio',
        'inscribiendo.cantidad.numeric' => 'La cantidad ser un número (puede contener decimales)',
        'inscribiendo.cantidad.min' => 'La cantidad no es válida',
        'inscribiendo.idGrupo.required' => 'El grupo es obligatorio',
        'inscribiendo.idGrupo.integer' => 'Debes seleccionar un grupo',
        'inscribiendo.idGrupo.min' => 'Debes seleccionar un grupo',
    ];

    //Para usar la paginación e indicar el tema 
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Variables a las que JavaScript tiene acceso
    public $busqueda;
    public $cantidadRegistros;
    public $planesEstudio;
    public $cardex;
    public $inscribiendo = [
        'id' => null,
        'planEstudio' => null,
        'idioma' => null,
        'numeroModulo' => null,
        'cantidad' => null,
        'tipoAlumno' => null,
        'idGrupo' => null,
        'folio' => null,
        'grupo' => null,
        'docente' =>  null,
        'alumno' => null,
        'modulo' => null,
        'cantidadAdeudo' =>  null, 
        'fechaAdeudo' => null,  
        'descripcionAdeudo' => "",
        'aCursar'=> null,
        'cardex' => null,  //ALMACENA BOOLEANO SI EL ALUMNO YA TIENE CREADO SU CARDEX
    ];
    public $listaAlumnos;

    private $alumnosPaginado;


    public function mount()
    {
        $this->busqueda = '';
        $this->cantidadRegistros = 10;
        $this->updatedBusqueda();

        $planesEstudio = Planestudio::all();
        $this->planesEstudio = [];
        foreach ($planesEstudio as $planEstudio) {
            //Inicializar la clase
            if (!isset($this->planesEstudio[$planEstudio->ID_PLANESTUDIO]))
                $this->planesEstudio[$planEstudio->ID_PLANESTUDIO] = [];

            $this->planesEstudio[$planEstudio->ID_PLANESTUDIO]['idioma'] = $planEstudio->PLAN_NOMBRE_IDIOMA;
            $this->planesEstudio[$planEstudio->ID_PLANESTUDIO]['numero_modulos'] = $planEstudio->PLAN_CMOD;

            $modulos = Modulo::where('ID_PLANESTUDIO', $planEstudio->ID_PLANESTUDIO)->get();
    
            foreach ($modulos as $modulo) {
                $grupos = Grupo::
                join('modulos',  'modulos.ID_MODULO', '=', 'grupos.ID_MODULO')->
                join('planestudios',  'planestudios.ID_PLANESTUDIO', '=', 'modulos.ID_PLANESTUDIO')->
                select(
                    'grupos.*',
                    'modulos.*',
                    'planestudios.*',
                )->
                where('modulos.ID_MODULO', $modulo->ID_MODULO)->get();
               
                $this->planesEstudio[$planEstudio->ID_PLANESTUDIO]['modulos'][$modulo->ID_MODULO]['grupos'] = $grupos;
                
            }
        }


        $this->fillListaAlumnos();
    }

    public function cancelarInscripcion()
    {
        $this->reset('inscribiendo');
    }

    public function validarMonto(){
       if($this->inscribiendo['cantidad'] < 700){
        
       }
    }

    public function inscribir(){
        $this->validate();

        $grupo = Grupo::find($this->inscribiendo['idGrupo']);

        //ASIGNA ID DEL DOCENTE Y EL MODULO
        $this->inscribiendo['docente']= $grupo["ID_DOCENTE"];
        $this->inscribiendo['modulo']= $grupo["ID_MODULO"];

        $modulo = $grupo->modulo()->first();
       
        //CREAR INSCRIPCION
        $inscripcion = Inscripcione::create([
            'ID_INSCRIPCION' => $this->inscribiendo['folio']  ,
            'ID_GRUPO' => $this->inscribiendo['idGrupo'],
            'ID_ALUMNO' => $this->inscribiendo['id'],
            'ID_DOCENTE' => $this->inscribiendo['docente'],
            'ID_MODULO' => $this->inscribiendo['modulo'],
            'INSCRIPCION_NUM_FOLIO' => $this->inscribiendo['folio'],
            'INSCRIPCION_MONTO' => $this->inscribiendo['cantidad'],
            'INSCRIPCION_FECHA' => date('Y-m-d H:i:s'),
            'INSCRIPCION_ PERIODO' => 'ENE-JUL',
            'INSCRIPCION_ANIO' => 2020,
        ]);
        
         //VALIDAR SI EXISTE CARDEX
         if(!$this->inscribiendo['cardex']){
            $cardex=Cardex::create([
              'ID_ALUMNO' => $this->inscribiendo['id'],
              'ID_PLANESTUDIO' => $this->inscribiendo['planEstudio'],
              'CARDEX_CALIF_MOD1' => 0,
              'CARDEX_CALIF_MOD2' => 0,
              'CARDEX_CALIF_MOD3' => 0,
              'CARDEX_CALIF_MOD4' => 0,
              'CARDEX_CALIF_MOD5' => 0,
              'CARDEX_CALIF_MOD6' => 0,
              'CARDEX_CALIF_MOD7' => 0,
              'CARDEX_CALIF_MOD8' => 0,
              'CARDEX_CALIF_MOD9' => 0,
              'CARDEX_CALIF_MOD10' => 0,
              'CARDEX_ACREDITADO' => 'f',
             ]);
         }
        $inscripcion->save();
        //Crear Calificación
        $calificacion = Calificacione::create([
            'ID_CALIF' => $this->inscribiendo['folio'],
            'ID_ALUMNO' => $this->inscribiendo['id'],
            'ID_GRUPO' => $this->inscribiendo['idGrupo'],
            'ID_INSCRIPCION' => $this->inscribiendo['folio'],
            'CALIF_PARCIAL1' => 0,
            'CALIF_PARCIAL2' => 0,
            'CALIF_PARCIAL3' => 0,
            'CALIF_PARCIAL4' => 0,
        ]);
        $calificacion->save();

        //Incrementa un alumno al grupo
        $grupo["GRUPO_NUM_ALUMNOS"] = $grupo["GRUPO_NUM_ALUMNOS"]+1;
        $grupo->save();
        //Valida si existe un adeudo
         if($this->inscribiendo['cantidadAdeudo']!=null){
         $adeudo = Adeudo::create([
            'ID_ADEUDO' => 1,
            'ID_INSCRIPCION' => $this->inscribiendo['folio'],
            'ID_ALUMNO' => $this->inscribiendo['id'],
            'ADEUDO_MONTO' => $this->inscribiendo['cantidadAdeudo'],
            'ADEUDO_FECHA' =>  $this->inscribiendo['fechaAdeudo'],
            'ADEUDO_DESCRIPCION' => $this->inscribiendo['descripcionAdeudo']

         ]);
         $adeudo->save();
         }

        return redirect()->to('/inscripcion'); 
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function llenarInscripcion($idAlumno,$nombreAlumno, $idPlan)
    {
        $this->inscribiendo['id'] =  $idAlumno;
        $this->inscribiendo['planEstudio'] = $idPlan;
        $this->inscribiendo['idioma'] = $this->planesEstudio[$idPlan]['idioma'];
        $this->inscribiendo['alumno'] = $nombreAlumno;
        $this->inscribiendo['numeroModulo']= $this->validarModulo($idPlan,$idAlumno);
        
    }
    
    public function validarModulo($idPlan, $idAlumno){
        if(Cardex::where('ID_ALUMNO',$idAlumno)->where('ID_PLANESTUDIO',$idPlan)->exists()){
            $cardex=Cardex::where('ID_ALUMNO',$idAlumno)->where('ID_PLANESTUDIO',$idPlan)->first();
            $this->inscribiendo['cardex']=true;
            return $this->ultimoModuloCursado($cardex);
        }else{
            $this->inscribiendo['cardex']=false;
            return 1;
        }
    }

    private function fillListaAlumnos()
    {
        $this->listaAlumnos = [];
        if ($this->busqueda == '') {
            //Cuando no se ha ingresado ninguna búsqueda, se obtienen todos los alumnos registrados
            $this->alumnosPaginado = Alumno::paginate($this->cantidadRegistros);
        } else {
            $this->alumnosPaginado = $this->buscarCampos(['ALUMNO_NOMBRE', 'ALUMNO_APELLIDO_PAT', 'ALUMNO_APELLIDO_MAT', 'ID_ALUMNO'], $this->busqueda, Alumno::class)->paginate($this->cantidadRegistros);
        }

        foreach ($this->alumnosPaginado as $alumno) {
            $usuario = User::where('email', $alumno->ALUMNO_CORREO)->first();
            $registro = [];

            $registro['correo'] = $usuario->email;
            $registro['tipo'] = 'alumno';
            $registro['id'] = $alumno->ID_ALUMNO;
            $registro['nombre'] = $alumno->ALUMNO_NOMBRE . ' ' . $alumno->ALUMNO_APELLIDO_PAT . ' ' . $alumno->ALUMNO_APELLIDO_MAT;

            $grupos = $alumno->grupos()->get();
           
           
                
            foreach ($grupos as $grupo) {
                $registro['grupos'][$grupo->modulo()->first()->planestudio()->first()->ID_PLANESTUDIO] = $grupo->ID_GRUPO;
            }
            $registro['ultimoModulo'] = $alumno->lastCardex();

            $this->listaAlumnos[$registro['id']] = $registro;
        } 
      
        }
        

    private static function buscarCampos(array $campos, string $busqueda, $modelo)
    {
        //separar la búsqueda en un array de palabras
        $palabras = explode(' ', $busqueda);

        //obtenemos una búsqueda inicial del modelo
        $modelo = $modelo::query();

        //para cada palabra se realiza una búsqueda que deberá coincidir con las demás palabras (where)
        foreach ($palabras as $palabra) {
            if ($palabra !== "") {
                $modelo = $modelo->where(function ($query) use ($campos, $palabra) {
                    foreach ($campos as $campo) {
                        //para cada campo se realiza la búsqueda que no forzosamente coincidirá con los demás campos (orWhere)
                        $query->orWhere($campo, 'like', '%' . $palabra . '%');
                    }
                });
            }
        }

        //Se retorna la query con todos los resultados de la búsqueda
        return $modelo;
    }


    public function updatedBusqueda()
    {
        //reiniciar la paginación
        $this->resetPage();
        $this->fillListaAlumnos();
    }

    public function render()
    {
        $this->fillListaAlumnos();

        return view('livewire.inscripcion', ['listaAlumnos' => $this->listaAlumnos, 'alumnosPaginado' => $this->alumnosPaginado]);
    }
    public function ultimoModuloCursado($listaCalificaciones){
        
        $modulo=0;
        if($listaCalificaciones->CARDEX_CALIF_MOD1==0){
            return $modulo=1;
         }elseif($listaCalificaciones->CARDEX_CALIF_MOD2==0){
            return $modulo=2;
         }elseif($listaCalificaciones->CARDEX_CALIF_MOD3==0){
            return $modulo=3;
         }elseif($listaCalificaciones->CARDEX_CALIF_MOD4==0){
            return $modulo=4;
         }elseif($listaCalificaciones->CARDEX_CALIF_MOD5==0){
            return $modulo=5;
         }elseif($listaCalificaciones->CARDEX_CALIF_MOD6==0){
            return $modulo=6;
         }elseif($listaCalificaciones->CARDEX_CALIF_MOD7==0){
            return $modulo=7;
         }elseif($listaCalificaciones->CARDEX_CALIF_MOD8==0){
            return $modulo=8;
         }elseif($listaCalificaciones->CARDEX_CALIF_MOD9==0){
            return $modulo=9;
         }elseif($listaCalificaciones->CARDEX_CALIF_MOD10==0){
            return $modulo=10;
         }
            

    }
}
