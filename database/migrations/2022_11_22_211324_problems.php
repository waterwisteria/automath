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
        Schema::create('problem_definitions', function (Blueprint $table) {
            $table->id();
            $table->string('description', 100);
            $table->string('instigator', 100);
            $table->string('problem', 100);
            $table->string('solver', 100);
            $table->timestamps();
            $table->comment('Basic problem definitions');
        });

        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->integer('problem_definition_id')->unsigned();
            $table->string('description', 100);
            $table->integer('problems')->unsigned();
            $table->integer('target_score')->unsigned();
            $table->integer('target_time')->unsigned();
            $table->string('instigator_params', 256);
            $table->timestamps();
            $table->comment('Problems adjusted for skills');
        });

        Schema::create('quizzes', function(Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('status', 16);
            $table->integer('score')->unsigned()->nullable(); // 6789 / 100 = 67.89%
            $table->timestamps();
            $table->comment('Individual quiz');
        });

        Schema::create('quiz_entries', function(Blueprint $table) {
            $table->id();
            $table->integer('quiz_id')->unsigned();
            $table->integer('problem_id')->unsigned();
            $table->string('vars', 256);
            $table->string('solution', 256)->nullable();
            $table->integer('score')->unsigned()->nullable();
            $table->timestamps();
            $table->comment('Where generated user problems are stored');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problem_definitions');
        Schema::dropIfExists('problems');
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('quiz_entries');
    }
};
