<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname', 50)->after('name');
            $table->string('address', 100);
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->string('cv')->nullable();
            $table->text('services')->nullable();
            $table->string('reviews')->nullable();
            $table->string('messages')->nullable();
            $table->string('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('surname');
            $table->dropColumn('adress');
            $table->dropColumn('phone');
            $table->dropColumn('photo');
            $table->dropColumn('cv');
            $table->dropColumn('services');
            $table->dropColumn('reviews');
            $table->dropColumn('messages');
            $table->dropColumn('slug');
        });
    }
}
