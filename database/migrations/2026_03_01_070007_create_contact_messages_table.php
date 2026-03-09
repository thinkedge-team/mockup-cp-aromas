<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('product')->nullable();
            $table->string('volume')->nullable();
            $table->string('city');
            $table->text('message');
            $table->json('attachments')->nullable(); // array of stored file paths
            $table->enum('status', ['new', 'in_progress', 'done', 'rejected'])->default('new');
            $table->text('notes')->nullable(); // catatan internal tim
            $table->string('followed_up_by')->nullable(); // nama/user yang follow-up
            $table->timestamp('followed_up_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
