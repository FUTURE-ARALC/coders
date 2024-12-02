<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true);
            $table->unsignedBigInteger('tenant_id')->nullable(false);
            $table->uuid('uuid');
            $table->text('name')->nullable(false);
            $table->string('email')->unique(); // Email único, usando string
            $table->text('password')->nullable(false);
            $table->boolean('active')->default(true)->nullable(false);
            $table->datetimes();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');

    }
}
