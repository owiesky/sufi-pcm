<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name');
            $table->string('phone')->unique()->after('username');
            $table->boolean('is_superuser')->default(false)->after('remember_token');
            $table->boolean('is_manager')->default(false)->after('is_superuser');
            $table->boolean('is_staff')->default(false)->after('is_manager');
            $table->boolean('is_kalap')->default(false)->after('is_staff');
            $table->boolean('is_doket')->default(false)->after('is_kalap');
            $table->boolean('is_registered')->default(true)->after('is_doket');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('is_superuser');
            $table->dropColumn('is_manager');
            $table->dropColumn('is_staff');
            $table->dropColumn('is_kalap');
            $table->dropColumn('is_doket');
            $table->dropColumn('is_registered');
        });
    }
};
