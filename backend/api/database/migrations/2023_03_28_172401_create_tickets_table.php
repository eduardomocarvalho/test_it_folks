<?php

use App\Entities\Category;
use App\Models\TicketStatus;
use App\Models\User;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 60);
            $table->text('description');
            $table->text('resolution');
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->foreignIdFor(Category::class)->nullable()->constrained();
            $table->foreignIdFor(TicketStatus::class)->nullable()->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
