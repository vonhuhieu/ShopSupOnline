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
            $table->string('phone')->after('password')->nullable();
            $table->string('address')->after('phone')->nullable();
            $table->foreignId('country_id')->after('address')->nullable()->references('id')->on('countries')->onUpdate('cascade')->onDelete('set null');
            $table->string('avatar')->after('country_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn([
                'phone',
                'address',
                'country_id',
                'avatar',
            ]);
        });
    }
};
