<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <-- needed for inserts
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->dateTime('due_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert sample data
        DB::table('tasks')->insert([
            [
                'title' => 'Finish Laravel project',
                'description' => 'Complete the backend and API endpoints',
                'status' => 'in_progress',
                'priority' => 'high',
                'due_date' => now()->addDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Read Laravel documentation',
                'description' => 'Go through validation and Eloquent sections',
                'status' => 'pending',
                'priority' => 'medium',
                'due_date' => now()->addDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Write unit tests',
                'description' => 'Test all controllers and models',
                'status' => 'pending',
                'priority' => 'urgent',
                'due_date' => now()->addDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Deploy to server',
                'description' => 'Deploy the application to staging server',
                'status' => 'pending',
                'priority' => 'high',
                'due_date' => now()->addDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Review code',
                'description' => 'Check code for consistency and best practices',
                'status' => 'completed',
                'priority' => 'low',
                'due_date' => now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};