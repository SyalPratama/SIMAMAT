<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id utama, AUTO_INCREMENT

            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable()->index();
            $table->string('password', 255)->nullable();

            $table->string('nim', 30)->nullable()->index();
            $table->string('nidn', 30)->nullable()->index();
            $table->string('nip', 50)->nullable();

            $table->enum('role', ['superadmin', 'dosen', 'mahasiswa']);
            $table->enum('status', ['active', 'lulus', 'suspend'])->default('active');

            $table->unsignedBigInteger('prodi_id')->nullable()->index();
            $table->unsignedBigInteger('semester_id')->nullable()->index();

            $table->timestamps(); // created_at dan updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
