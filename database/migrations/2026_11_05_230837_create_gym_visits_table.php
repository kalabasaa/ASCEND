<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gym_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->restrictOnDelete();
            $table->dateTime('check_in');
            $table->date('visit_date')->storedAs('DATE(check_in)');
          

            $table->unique(['member_id', 'visit_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gym_visits');
    }
};