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
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->date('start_date');
			$table->date('end_date');
			$table->text('notes')->nullable();
			$table->text('description')->nullable();
			$table->boolean('is_active')->default(true); 
            $table->enum('status_id',['PENDING','IN_PROGRESS','COMPLETED','ACCEPTED']);
			// $table->string('status_id')->default('pending');
			$table->integer('project_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
