<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Cierre;
use App\Models\Grupo;
use App\Models\Modulo;
use App\Models\Calificacione;
use App\Models\Inscripcione;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use stdClass;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class ModificarCalificacion extends Component
{
   
    
    //Reglas de validación basadas en propiedades
    protected function rules()
    {
        $rules = [];

        $rules['grupo'] = 'required';

        foreach ($this->listaCalificaciones as $alumno => $calificacion) {
            //Cada alumno tiene 4 parciales que serán validados
            $rules["listaCalificaciones." . $alumno . ".CALIF_PARCIAL1"] = 'required|numeric|min:0|max:100';
            $rules["listaCalificaciones." . $alumno . ".CALIF_PARCIAL2"] = 'required|numeric|min:0|max:100';
            $rules["listaCalificaciones." . $alumno . ".CALIF_PARCIAL3"] = 'required|numeric|min:0|max:100';
            $rules["listaCalificaciones." . $alumno . ".CALIF_PARCIAL4"] = 'required|numeric|min:0|max:100';
        }
        return $rules;
    }

    protected $messages = [
        'listaCalificaciones.*.*.required' => 'La calificación es requierida',
        'listaCalificaciones.*.*.numeric' => 'La calificación debe ser un número',
        'listaCalificaciones.*.*.min' => 'La calificación debe ser mayor a 0',
        'listaCalificaciones.*.*.max' => 'La calificación debe ser menor a 100',
    ];



    //Reglas de validación en tiempo real
    protected function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    //Escucha para eventos
    protected $listeners = ['grupoChanged' => 'onGrupoChanged'];

     //Para usar la paginación e indicar el tema 
     use WithPagination;
     protected $paginationTheme = 'bootstrap';

    //Propiedades públicas
    public $listaAlumnos = [];
    public $listaGrupos = [];
    public $listaCalificaciones = [];
    public $parcial = [];
    public $parcial1 = false;  
    public $parcial2 = false;  
    public $parcial3 = false;  
    public $parcial4 = false;  
    public $grupo = null;
    public $busqueda;
    public $cantidadRegistros=10;
    
    private $alumnosPaginado;

    public function mount()
    {
        if ($this->grupo == null) {

            if(sizeof($this->listaGrupos) > 0){
                $this->grupo = $this->listaGrupos[0]->ID_GRUPO;
            } else {
                return;
            }
        }
        $this->parcial = Cierre::first()->parcial;
        $parciales = json_decode($this->parcial);
        foreach($parciales as $p => $estadoParciales){
            switch($p){
                case "parcial1":
                    $this->parcial1 = $estadoParciales;
                    break;
                case "parcial2":
                    $this->parcial2 = $estadoParciales;
                    break;
                case "parcial3":
                    $this->parcial3 = $estadoParciales;
                    break;
                case "parcial4":
                    $this->parcial4 = $estadoParciales;
                     break;
                     default:

                     break;     

            }

        }
        $this->fillListaAlumnos();
        
    }


        private function fillListaAlumnos()
        {
            
            $this->listaAlumnos=[];
               if ($this->busqueda == '') {
                $this->alumnosPaginado = Calificacione::
                    join('inscripciones','calificaciones.ID_GRUPO', '=', 'inscripciones.ID_GRUPO')->
                    join('alumnos','alumnos.ID_ALUMNO','=','calificaciones.ID_ALUMNO')->
                    where('inscripciones.ID_GRUPO', $this->grupo)->groupBy('alumnos.ID_ALUMNO')->paginate($this->cantidadRegistros);
                    
               } else {
                   $this->alumnosPaginado = $this->buscarCampos(['ALUMNO_NOMBRE', 'ALUMNO_APELLIDO_PAT', 'ALUMNO_APELLIDO_MAT', 'ID_ALUMNO'], $this->busqueda, Alumno::class)->paginate($this->cantidadRegistros);
               }
                $lista=[];
               foreach ($this->alumnosPaginado as $i => $alumno){

                $lista['ID_ALUMNO'] =  $alumno->ID_ALUMNO;
                $lista['ALUMNO_NOMBRE'] =  $alumno->ALUMNO_NOMBRE;
                $lista['ALUMNO_APELLIDO_PAT'] =  $alumno->ALUMNO_APELLIDO_PAT;
                $lista['ALUMNO_APELLIDO_MAT'] =  $alumno->ALUMNO_APELLIDO_MAT;

                $lista['CALIF_PARCIAL1'] = $alumno->CALIF_PARCIAL1;
                $lista['CALIF_PARCIAL2'] = $alumno->CALIF_PARCIAL2;
                $lista['CALIF_PARCIAL3'] = $alumno->CALIF_PARCIAL3;
                $lista['CALIF_PARCIAL4'] = $alumno->CALIF_PARCIAL4;
                
           
                $this->listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL1'] = $alumno->CALIF_PARCIAL1;
                $this->listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL2'] = $alumno->CALIF_PARCIAL2;
                $this->listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL3']= $alumno->CALIF_PARCIAL3;
                $this->listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL4'] = $alumno->CALIF_PARCIAL4;
                $this->listaAlumnos[$i]=$lista;
                
             }
             $this->emit('grupoChanged');
       
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
        
    
    

    public function enviarCalificaciones($id)
    {

        if ($this->parcial !== -1) {
            foreach ($this->listaCalificaciones as $alumno => $calificacion) {

                $inscripcion = Calificacione::where('ID_ALUMNO', $alumno)->where('ID_GRUPO', $this->grupo)->first();
                
                        $inscripcion->CALIF_PARCIAL1 = $calificacion['CALIF_PARCIAL1'];
                        
                        $inscripcion->CALIF_PARCIAL2 = $calificacion['CALIF_PARCIAL2'];
                        
                        $inscripcion->CALIF_PARCIAL3= $calificacion['CALIF_PARCIAL3'];
                       
                        $inscripcion->CALIF_PARCIAL4 = $calificacion['CALIF_PARCIAL4'];
                       
                }
                $inscripcion->save();
            }
        }
    
    

    public function onGrupoChanged()
    {
    }

    public function render()
    {
    
        return view('livewire.modificar-calificacion');
    }
}
