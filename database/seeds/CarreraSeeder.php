<?php

use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        /*** Facultad de Medicina.  */


        DB::table('carreras')->insert([
            'codigo' => 'MED',
            'nombre' => 'Medicina',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'QFM',
            'nombre' => 'Química y Farmacia',
        ]);


        /*** Facultad de Ciencias de la educacion.  */


        DB::table('carreras')->insert([
            'codigo' => 'EDP - C',
            'nombre' => 'Educación Parvularia - Curico',
        ]);
        
        DB::table('carreras')->insert([
            'codigo' => 'PEE',
            'nombre' => 'Pedagogía en Educación Especial',
        ]);
        DB::table('carreras')->insert([
            'codigo' => 'EFI',
            'nombre' => 'Educacion Fisica',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'PGB - C',
            'nombre' => 'Pedagogía en Educación General Básica con Mención - Curicó',
        ]); 

        DB::table('carreras')->insert([
            'codigo' => 'PGB - T',
            'nombre' => 'Pedagogía en Educación General Básica con Mención - Talca',
        ]);
        DB::table('carreras')->insert([
            'codigo' => 'PIN',
            'nombre' => 'Pedagogía en Inglés',
        ]);
        
        DB::table('carreras')->insert([
            'codigo' => 'LCC',
            'nombre' => 'Pedagogía En lengua Castellana y Comunicación',
        ]);
        
        
        /*** Facultad de Ciencias de la Salud.  */


        DB::table('carreras')->insert([
            'codigo' => 'ENF - T',
            'nombre' => 'Enfermería - Talca',
        ]);
        DB::table('carreras')->insert([
            'codigo' => 'ENF - C',
            'nombre' => 'Enfermería - Curico',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'KIE',
            'nombre' => 'Kinesiología',
        ]);
        DB::table('carreras')->insert([
            'codigo' => 'NUTR',
            'nombre' => 'Nutrición y Dietética',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'PSI',
            'nombre' => 'Psicologia',
        ]);
        DB::table('carreras')->insert([
            'codigo' => 'TME',
            'nombre' => 'Tecnología Médica',
        ]);



        /*** Facultad de Ingeniería.  */


        DB::table('carreras')->insert([
            'codigo' => 'ARQ',
            'nombre' => 'Arquitectura',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'CCV',
            'nombre' => 'Construcción Civil Vespertino',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'ICI',
            'nombre' => 'Ingenieria Civil',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'ICE',
            'nombre' => 'Ingenieria Civil Electrónica',
        ]);


        DB::table('carreras')->insert([
            'codigo' => 'IND',
            'nombre' => 'Ingeniería Civil Industrial',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'INF',
            'nombre' => 'Ingenieria Civil Informática',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'IEI',
            'nombre' => 'Ingeniería Ejecución en computación e Informática',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'ICO',
            'nombre' => 'Ingenieria en Construcción',
        ]);



         /*** Facultad de Ciencias sociales y económica.  */

        
               
        DB::table('carreras')->insert([
            'codigo' => 'ADMP',
            'nombre' => 'Administración Pública',
        ]);       
        DB::table('carreras')->insert([
            'codigo' => 'AUDV - T',
            'nombre' => 'Auditoria Vespertino - Talca',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'AUDV - C',
            'nombre' => 'Auditoria Vespertino - Curico',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'INC',
            'nombre' => 'Ingeniería Comercial',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'SOC',
            'nombre' => 'Sociología',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'TSC - T',
            'nombre' => 'Trabajo Social - Talca',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'TSC - C',
            'nombre' => 'Trabajo Social - Curico',
        ]);


         /*** Facultad de Ciencias Agrarias y Forestales.  */
        

        DB::table('carreras')->insert([
            'codigo' => 'IRRN',
            'nombre' => 'Ingenieria En recursos Naturales',
        ]);
        DB::table('carreras')->insert([
            'codigo' => 'AGR',
            'nombre' => 'Agronomía',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'IBIO',
            'nombre' => 'Ingeniería en Biotecnología',
        ]);

        /*** Facultad de Ciencias básicas */
        
        DB::table('carreras')->insert([
            'codigo' => 'IESS',
            'nombre' => 'Ingeniería en Estadística',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'PCC',
            'nombre' => 'Pedagogía en Ciencias',
        ]);

        DB::table('carreras')->insert([
            'codigo' => 'PMC',
            'nombre' => 'Pedagogía en Matemáticas y Computación',
        ]);


        /*** Facultad de Ciencias básicas */

        DB::table('carreras')->insert([
            'codigo' => 'PCF',
            'nombre' => 'Pedagogía en Religión y Filosofía',
        ]);


        
        
    }
}
