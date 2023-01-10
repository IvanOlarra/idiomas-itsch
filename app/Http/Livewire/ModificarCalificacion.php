<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Cierre;
use App\Models\Grupo;
use App\Models\Calificacione;
use App\Models\Inscripcione;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use stdClass;
use Illuminate\Http\Request;

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
        $this->updatedGrupo();
    }

    public function updatedGrupo()
    { //Al cambiar el selector de grupo, se actualiza la lista de alumnos
        $grupo = Grupo::where('ID_GRUPO', $this->grupo)->first();
        $lista = $grupo->alumnos;

        //asignamos una inscripcion a cada alumno basado en su grupo
        $this->listaCalificaciones = [];

        foreach ($lista as $i => $alumno) {
            $inscripcion = Inscripcione::
            join('calificaciones', 'inscripciones.ID_ALUMNO', '=', 'calificaciones.ID_ALUMNO')->
            join('calificaciones as cal', 'inscripciones.ID_GRUPO', '=', 'cal.ID_GRUPO')->
            select('calificaciones.CALIF_PARCIAL1','calificaciones.CALIF_PARCIAL2','calificaciones.CALIF_PARCIAL3', 'calificaciones.CALIF_PARCIAL4')->
            where('inscripciones.ID_ALUMNO', $alumno->ID_ALUMNO)->get()->first();
            //Se agregan las calificaciones al response de alumnos
            $lista[$i]->CALIF_PARCIAL1 = $inscripcion->CALIF_PARCIAL1;
            $lista[$i]->CALIF_PARCIAL2 = $inscripcion->CALIF_PARCIAL2;
            $lista[$i]->CALIF_PARCIAL3 = $inscripcion->CALIF_PARCIAL3;
            $lista[$i]->CALIF_PARCIAL4 = $inscripcion->CALIF_PARCIAL4;
            $this->listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL1'] = $inscripcion->CALIF_PARCIAL1;
            $this->listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL2'] = $inscripcion->CALIF_PARCIAL2;
            $this->listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL3']= $inscripcion->CALIF_PARCIAL3;
            $this->listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL4'] = $inscripcion->CALIF_PARCIAL4;
       
        }
        //Guardamos los datos en la lista de alumnos
        $this->listaAlumnos = $lista;
        $this->emit('grupoChanged');
    }

    public function enviarCalificaciones()
    {
        $this->validate();

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
