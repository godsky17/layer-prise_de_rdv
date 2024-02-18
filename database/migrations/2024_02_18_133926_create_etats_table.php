<?php

use App\Models\Etat;
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
        Schema::create('etats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('rendezvouses', function(Blueprint $table){
            $table->foreignIdFor(Etat::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etats');
        Schema::table('rendezvouses', function(Blueprint $table){
            $table->dropForeignIdFor(Etat::class);
        });
    }
};
