<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('type')->default(0)->comment('0=book, 1=videos');
            $table->unsignedBigInteger('resources')->default(0)->comment('resources count');
            $table->unsignedBigInteger('year');
            $table->float('price')->default(0.00);
            $table->string('image')->nullable();
            $table->text('description');
            $table->text('link');
            $table->unsignedBigInteger('submitted_by');
            $table->unsignedBigInteger('duration');
            $table->unsignedBigInteger('plateform_id');

            $table->foreign('submitted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plateform_id')->references('id')->on('platforms')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('course_series', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('series_id');
            $table->unique(['course_id', 'series_id']);

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('course_topic', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('topic_id');
            $table->unique(['course_id', 'topic_id']);

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('course_author', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('author_id');
            $table->unique(['course_id', 'author_id']);

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('courses');
    }
};
