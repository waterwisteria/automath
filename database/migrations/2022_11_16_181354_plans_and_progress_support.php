<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        return;
        
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->timestamps();
        });

        Schema::create('plan_units', function (Blueprint $table) {
            $table->id();
            $table->integer('plans_id')->unsigned();
            $table->string('practice_unit', 100);
            $table->integer('sort')->unsigned();
            $table->timestamps();
            $table->unique([ 'plans_id', 'practice_unit' ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('current_plan')->unsigned()->default(0);
            $table->integer('last_unit_completed')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        return;
        
        Schema::dropIfExists('plans');
        Schema::dropIfExists('plan_units');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('current_plan');
            $table->dropColumn('last_unit_completed');
        });
    }
};
