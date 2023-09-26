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
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('client');
			$table->double('budget');
			$table->date('start_date');
			$table->date('end_date');
            $table->softDeletes();
			$table->text('notes')->nullable();
			$table->text('description')->nullable();
			$table->boolean('is_active')->default(true); 
			$table->integer('category_id')->unsigned();
            $table->string('image');
            $table->enum('status_id',['PENDING','IN_PROGRESS','COMPLETED','REJECTED']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
