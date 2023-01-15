<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // NIVEL INDEPENDIENTE
        Schema::create('secretarias', function (Blueprint $table) {
            $table->integer('ID_SECRETARIAL')->primary();
            $table->string('SECRETARIA_CLAVE', 30);
            $table->string('SECRETARIA_AP_PAT', 30);
            $table->string('SECRETARIA_AP_MAT', 30)->nullable();
            $table->string('SECRETARIA_NOMBRE', 30);
            $table->string('SECRETARIA_SEXO', 10);
            $table->string('SECRETARIA_TIPO_SANGRE', 5)->nullable();
            $table->date('SECRETARIA_FECHA_NAC');
            $table->string('SECRETARIA_CALLE', 30);
            $table->string('SECRETARIA_COLONIA', 30);
            $table->string('SECRETARIA_MUNICIPIO', 30);
            $table->string('SECRETARIA_ESTADO', 30);
            $table->string('SECRETARIA_MOVIL', 30)->nullable();
            $table->string('SECRETARIA_CASA', 30)->nullable();
            $table->unsignedBigInteger('SECRETARIA_CORREO')->unique();
            $table->foreign('SECRETARIA_CORREO')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->string('SECRETARIA_CLAVE_PROFESIONAL', 30)->nullable();
            $table->string('SECRETARIA_ESPECIALIDAD', 30)->nullable();
            $table->date('SECRETARIA_FECHA_ING');
            $table->string('SECRETARIA_OBSERVACIONES', 500);
        });

     

        Schema::create('alumnos', function (Blueprint $table) {
            $table->string('ID_ALUMNO')->primary();
            $table->string('ALUMNO_APELLIDO_PAT', 30);
            $table->string('ALUMNO_APELLIDO_MAT', 30)->nullable();
            $table->string('ALUMNO_NOMBRE', 30);
            $table->string('ALUMNO_SEXO', 10);
            $table->string('ALUMNO_TIPO_SANGRE', 5)->nullable();
            $table->date('ALUMNO_FECHA_NAC');
            $table->string('ALUMNO_CALLE', 30);
            $table->string('ALUMNO_COLONIA', 30);
            $table->string('ALUMNO_MUNICIPIO', 30);
            $table->string('ALUMNO_ESTADO', 30);
            $table->string('ALUMNO_TELEFONO_PER', 30)->nullable();
            $table->string('ALUMNO_TELEFONO_CASA', 30)->nullable();
            $table->string('ALUMNO_CORREO',35);
            $table->string('ALUMNO_TUTOR_AR_PAT', 30)->nullable();
            $table->string('ALUMNO_TUTOR_AR_MAT', 30)->nullable();
            $table->string('ALUMNO_TUTOR_NOMBRE', 30)->nullable();
            $table->string('ALUMNO_CARRERA', 30);
            $table->string('ALUMNO_OBSERVACIONES', 500)->nullable();;
            $table->string('ALUMNO_STATUS', 20);
            $table->integer('ALUMNO_ING_ANIO');
        });

        Schema::create('docentes', function (Blueprint $table) {
            $table->integer('ID_DOCENTE')->primary();
            $table->string('DOCENTE_CLAVE', 30);
            $table->string('DOCENTE_AP_PAT', 30);
            $table->string('DOCENTE_AP_MAT', 30)->nullable();
            $table->string('DOCENTE_NOMBRE', 30);
            $table->string('DOCENTE_SEXO', 10);
            $table->string('DOCENTE_TIPO_SANGRE', 5);
            $table->date('DOCENTE_FECHA_NAC');
            $table->string('DOCENTE_CALLE', 30);
            $table->string('DOCENTE_COLONIA', 30);
            $table->string('DOCENTE_MUNICIPIO', 30);
            $table->string('DOCENTE_ESTADO', 30);
            $table->string('DOCENTE_MOVIL', 30)->nullable();
            $table->string('DOCENTE_CASA', 30)->nullable();
            $table->foreignId('DOCENTE_CORREO')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict')->unique();
            $table->string('DOCENTE_GRADO_ESCOLAR', 30)->nullable();
            $table->string('DOCENTE_ESPECIALIDAD', 30)->nullable();
            $table->date('DOCENTE_FECHA_ING');
            $table->string('DOCENTE_OBSERVACIONES', 500);
        });

        // NIVEL 1

        Schema::create('planestudios', function (Blueprint $table) {
            $table->integer('ID_PLANESTUDIO')->primary();
            $table->string('PLAN_CLAVE', 30);
            $table->string('PLAN_NOMBRE_IDIOMA', 20);
            $table->date('PLAN_IN');
            $table->date('PLAN_FIN');
            $table->string('PLAN_ESTADO', 10);
            $table->integer('PLAN_CMOD');
            
        });

        // NIVEL 2


        Schema::create('modulos', function (Blueprint $table) {
            $table->integer('ID_MODULO')->primary();
            $table->integer('ID_PLANESTUDIO');
            $table->foreign('ID_PLANESTUDIO')->references('ID_PLANESTUDIO')->on('planestudios')->onUpdate('restrict')->onDelete('restrict');
            $table->string('RETICULA_NOMBRE', 5);
            $table->integer('MODULO_NIVEL');

        });

        Schema::create('grupos', function (Blueprint $table) {
            $table->integer('ID_GRUPO')->primary();
            $table->integer('ID_MODULO');
            $table->foreign('ID_MODULO')->references('ID_MODULO')->on('modulos')->onUpdate('restrict')->onDelete('restrict');
            $table->integer('ID_DOCENTE');
            $table->foreign('ID_DOCENTE')->references('ID_DOCENTE')->on('docentes')->onUpdate('restrict')->onDelete('restrict');
            $table->string('GRUPO_TIPO', 8);
            $table->string('GRUPO_CLA', 6);
            $table->string('GRUPO_NOM_GRUPO');
            $table->string('GRUPO_DES', 50);
            $table->integer('GRUPO_NUM_ALUMNOS');
            $table->integer('GRUPO_LIMITE');
            $table->string('GRUPO_DIAS', 30);
            $table->string('GRUPO_HORAS', 30);
            $table->string('GRUPO_UBICACION', 6);
        });
      
        // NIVEL 3

        Schema::create('inscripciones', function (Blueprint $table) {
            $table->string('ID_INSCRIPCION')->primary();
            $table->integer('ID_GRUPO');
            $table->foreign('ID_GRUPO')->references('ID_GRUPO')->on('grupos')->onUpdate('restrict')->onDelete('restrict');
            $table->string('ID_ALUMNO');
            $table->foreign('ID_ALUMNO')->references('ID_ALUMNO')->on('alumnos')->onUpdate('restrict')->onDelete('restrict');
            $table->integer('ID_DOCENTE');
            $table->foreign('ID_DOCENTE')->references('ID_DOCENTE')->on('docentes')->onUpdate('restrict')->onDelete('restrict');
            $table->integer('ID_MODULO');
            $table->foreign('ID_MODULO')->references('ID_MODULO')->on('modulos')->onUpdate('restrict')->onDelete('restrict');
            $table->integer('INSCRIPCION_NUM_FOLIO');
            $table->integer('INSCRIPCION_MONTO');
            $table->date('INSCRIPCION_FECHA');
            $table->string('INSCRIPCION_PERIODO', 10);
            $table->integer('INSCRIPCION_ANIO');
        });

        Schema::create('adeudos', function (Blueprint $table) {
            $table->increments('ID_ADEUDO');
            $table->string('ID_INSCRIPCION');
            $table->foreign('ID_INSCRIPCION')->references('ID_INSCRIPCION')->on('inscripciones')->onUpdate('restrict')->onDelete('restrict');
            $table->string('ID_ALUMNO');
            $table->foreign('ID_ALUMNO')->references('ID_ALUMNO')->on('alumnos')->onUpdate('restrict')->onDelete('restrict');
            $table->integer('ADEUDO_MONTO')->nullable();
            $table->date('ADEUDO_FECHA')->nullable();
            $table->string('ADEUDO_DESCRIPCION', 30);
        });

        Schema::create('cardexes', function (Blueprint $table) {
            $table->integer('ID_CARDEX')->primary();
            $table->string('ID_ALUMNO');
            $table->foreign('ID_ALUMNO')->references('ID_ALUMNO')->on('alumnos')->onUpdate('restrict')->onDelete('restrict');
            $table->integer('ID_PLANESTUDIO');
            $table->foreign('ID_PLANESTUDIO')->references('ID_PLANESTUDIO')->on('planestudios')->onUpdate('restrict')->onDelete('restrict');
            $table->float('CARDEX_CALIF_MOD1');
            $table->float('CARDEX_CALIF_MOD2');
            $table->float('CARDEX_CALIF_MOD3');
            $table->float('CARDEX_CALIF_MOD4');
            $table->float('CARDEX_CALIF_MOD5');
            $table->float('CARDEX_CALIF_MOD6');
            $table->float('CARDEX_CALIF_MOD7');
            $table->float('CARDEX_CALIF_MOD8');
            $table->float('CARDEX_CALIF_MOD9');
            $table->float('CARDEX_CALIF_MOD10');
            $table->string('CARDEX_ACREDITADO', 3);
        });

        Schema::create('calificaciones', function(Blueprint $table){
          $table->string('ID_CALIF')->primary();
          $table->string('ID_ALUMNO');
          $table->foreign('ID_ALUMNO')->references('ID_ALUMNO')->on('alumnos')->onUpdate('restrict')->onDelete('restrict');
          $table->integer('ID_GRUPO');
          $table->foreign('ID_GRUPO')->references('ID_GRUPO')->on('grupos')->onUpdate('restrict')->onDelete('restrict');
         $table->string('ID_INSCRIPCION');
          $table->foreign('ID_INSCRIPCION')->references('ID_INSCRIPCION')->on('inscripciones')->onUpdate('restrict')->onDelete('restrict');
          $table->float('CALIF_PARCIAL1');
          $table->float('CALIF_PARCIAL2');
          $table->float('CALIF_PARCIAL3');
          $table->float('CALIF_PARCIAL4');
          $table->float('CALIF_FINAL');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //nivel idependiente
        Schema::dropIfExists('secretarias');
        Schema::dropIfExists('administradors');
        Schema::dropIfExists('alumnos');
        Schema::dropIfExists('docentes');

        //nivel1
        Schema::dropIfExists('planestudios');
        Schema::dropIfExists('modulos');
        //nivel2
        Schema::dropIfExists('grupos');

        //NIVEL 3
        Schema::dropIfExists('inscripciones');


        //NIVEL4
        Schema::dropIfExists('adeudos');
        Schema::dropIfExists('cardex');
    }
}
