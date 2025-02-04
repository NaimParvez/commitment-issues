<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('roadmaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('course_name');
            $table->integer('duration'); // Weeks
            $table->enum('level', ['beginner', 'intermediate', 'advanced']);
            $table->text('purpose');
            $table->longText('response')->nullable(); // AI response
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('roadmaps');
    }
};
