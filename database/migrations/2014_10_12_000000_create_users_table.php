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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('contact')->unique();
            $table->string('image')->default('default.jpg');
            $table->integer('role')->default('4');
            $table->integer('type')->default('1')->comment('1 = regular member, 2 = family member');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('0')->comment('1 = active, 0 = inactive');
            $table->rememberToken();
            $table->timestamp('last_visit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
};
