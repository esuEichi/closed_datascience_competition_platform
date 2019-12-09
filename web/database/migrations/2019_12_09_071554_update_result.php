<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('results', function (Blueprint $table) {
            $table->string('opt_score1')->after('score')->nullable();
            $table->string('opt_score2')->after('opt_score1')->nullable();
            $table->string('opt_score3')->after('opt_score2')->nullable();
            $table->string('opt_score4')->after('opt_score3')->nullable();
            $table->string('opt_score5')->after('opt_score4')->nullable();
            $table->string('opt_score6')->after('opt_score5')->nullable();
            $table->string('opt_score7')->after('opt_score6')->nullable();
            $table->string('opt_score8')->after('opt_score7')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('results', function (Blueprint $table) {
            $table->dropColumn('opt_score1');
            $table->dropColumn('opt_score2');
            $table->dropColumn('opt_score3');
            $table->dropColumn('opt_score4');
            $table->dropColumn('opt_score5');
            $table->dropColumn('opt_score6');
            $table->dropColumn('opt_score7');
            $table->dropColumn('opt_score8');
        });
    }
}
