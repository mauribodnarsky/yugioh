<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->boolean('first_series')->default(null)->nullable();

            $table->integer('atk')->nullable();
            $table->integer('def')->nullable();
            $table->decimal('stars',5,2);
            $table->string('description');
            $table->decimal('price', 6, 2);
            $table->string('image');
            $table->unsignedBigInteger('id_type_card');
            $table->foreign('id_type_card')->references('id')->on('types_cards');
            $table->unsignedBigInteger('id_subtype_card');
            $table->foreign('id_subtype_card')->references('id')->on('sub_types_cards');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
