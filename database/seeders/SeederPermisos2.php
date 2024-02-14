<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederPermisos2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::query()->delete();

        $permisos = [
            //Operaciones sobre tabla usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',            
            //Operaciones sobre tabla ligas
            'ver-liga',
            'crear-liga',
            'editar-liga',
            'borrar-liga',
            //Operaciones sobre tabla torneos
            'ver-torneo',
            'crear-torneo',
            'editar-torneo',
            'borrar-torneo',
            //Operaciones sobre tabla jugadores
            'ver-jugador',
            'crear-jugador',
            'editar-jugador',
            'borrar-jugador',
            //Operaciones sobre tabla entrenadores
            'ver-entrenador',
            'crear-entrenador',
            'editar-entrenador',
            'borrar-entrenador',
            //Operaciones sobre tabla arbitros
            'ver-arbitro',
            'crear-arbitro',
            'editar-arbitro',
            'borrar-arbitro',
            //Operaciones sobre tabla estadio 
            'ver-estadio',
            'crear-estadio',
            'editar-estadio',
            'borrar-estadio',

            //permisos sobre la tabla categorias
            'ver-categoria',
            'crear-categoria',
            'editar-categoria',
            'borrar-categoria',
            
            //permisos sobre la tabla clubs
            'ver-club',
            'crear-club',
            'editar-club',
            'borrar-club',

            //permisos sobre la tabla equipos
            'ver-equipo',
            'crear-equipo',
            'editar-equipo',
            'borrar-equipo',
            //permisos sobre la tabla partidos
            'ver-partido',
            'crear-partido',
            'editar-partido',
            'borrar-partido',
            //permisos sobre la tabla estadisticas partidos
            'ver-estadistica-partido',
            'crear-estadistica-partido',
            'editar-estadistica-partido',
            'borrar-estadistica-partido',
            //permisos sobre la tabla jugadores encuentros
            'ver-jugador-encuentro',
            'crear-jugador-encuentro',
            'editar-jugador-encuentro',
            'borrar-jugador-encuentro',
            //permisos sobre la tabla jugadores cambios
            'ver-jugador-cambio',
            'crear-jugador-cambio',
            'editar-jugador-cambio',
            'borrar-jugador-cambio',
            


        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
