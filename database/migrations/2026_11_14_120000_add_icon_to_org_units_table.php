<?php

use App\Enums\OrgUnitType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('org_units', function (Blueprint $table) {
            $table->string('icon')->nullable();
        });

        // Keep today's look: sectors get their icon by current order
        // (industrial, commercial, financial, services). Anything else falls back to "bolt".
        $icons = ['factory', 'store', 'bank', 'bolt'];

        DB::table('org_units')
            ->where('type', OrgUnitType::Sector->value)
            ->orderBy('order')
            ->get()
            ->each(function ($row, $index) use ($icons) {
                DB::table('org_units')
                    ->where('id', $row->id)
                    ->update(['icon' => $icons[$index] ?? 'bolt']);
            });
    }

    public function down(): void
    {
        Schema::table('org_units', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};
