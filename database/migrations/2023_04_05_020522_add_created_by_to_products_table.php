<?php

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
        $user = User::create([
            'name' => 'Administrador'
        ]);

        Schema::table('products', function (Blueprint $table) use ($user) {
            $table->unsignedBigInteger('created_by')->default($user->id);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
    }
};
