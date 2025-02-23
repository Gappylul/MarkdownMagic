<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->timestamps();
            
            // Create a unique index for user_id and slug combination
            $table->unique(['user_id', 'slug']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
} 