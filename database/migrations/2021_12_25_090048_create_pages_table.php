<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->morphs('pageable');
            $table->foreignId('page_id')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('slug');
            $table->string('header_1')->nullable();
            $table->enum('og_type', ['website', 'article'])->default('website');
            $table->string('og_title')->nullable();
            $table->foreignId('og_image')->nullable()->references('id')->on('images');
            $table->string('og_description')->nullable();
            $table->enum('twitter_card', ['summary', 'summary_large_image', 'app', 'player'])->default('summary');
            $table->string('twitter_site')->comment('@username of website. Either twitter:site or twitter:site:id is required.')->nullable();
            $table->string('twitter_title', 70)->comment('Title of content (max 70 characters)')->nullable();
            $table->string('twitter_description', 200)->comment('Description of content (maximum 200 characters)')->nullable();
            $table->foreignId('twitter_image')->nullable()->references('id')->on('images');
            $table->foreignId('cover_id')->nullable()->references('id')->on('images');
            $table->boolean('show_in_menu')->default(false);
            $table->dateTimeTz('approved_at')->nullable();
            $table->dateTimeTz('expires_at')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
