<?php

use Illuminate\Database\Seeder;

class ResultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*
            $table->bigIncrements('id');
            $table->integer('competition_id');
            $table->integer('user_id');
            $table->string('score');
            $table->timestamps();
*/ 
        DB::table('results')->insert([
            [
              'id' => 1,
              'competiton_id' => 1,
              'user_id' => 1,
              'score' => '87.6',
            ],
            [
                'id' => 2,
                'competiton_id' => 1,
                'user_id' => 1,
                'score' => '87.4',
            ],
            [
                'id' => 3,
                'competiton_id' => 1,
                'user_id' => 1,
                'score' => '80.4',
            ],
        ]);
    }
}
