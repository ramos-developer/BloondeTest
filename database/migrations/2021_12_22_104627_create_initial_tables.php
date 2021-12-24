<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });

        Schema::create('hobbies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('customers_hobbies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('hobbie_id')->constrained('hobbies')->onUpdate('cascade')->onDelete('cascade');
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
        // CUSTOMERS_HOBBIES TABLE
        Schema::table('customers_hobbies', function(Blueprint $table) {
            $table->dropForeign(['hobbie_id']);
            $table->dropForeign(['customer_id']);
        });
        Schema::dropIfExists('customers_hobbies');

        // HOBBIES TABLE
        Schema::dropIfExists('hobbies');

        // CUSTOMERS TABLE
        Schema::table('customers', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('customers');
    }
}
