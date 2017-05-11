<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            // crée un champ VARCHAR avec une longueur
            $table->string('title', 60)->unique();
            // permet de rajouter un attribut unique
            $table->string('slug', 80)->unique();
            $table->dateTime('date');
            // un champ de type LONGTEXT
            $table->longText('hat');
            // un champ de type LONGTEXT
            $table->longText('content');
            $table->string('image', 255);
            $table->boolean('online');
            // crée 2 champs crée à et modifié à
            $table->timestamps();
            $table->integer('user_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
