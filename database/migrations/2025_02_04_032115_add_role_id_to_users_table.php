<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Pastikan field role_id berada setelah kolom tertentu (misalnya setelah kolom 'id')
            $table->unsignedBigInteger('role_id')->after('id')->default(2); // default role_id 2 (user)
            
            // Jika ingin menambahkan foreign key
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key terlebih dahulu, lalu drop kolomnya
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}