<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $fixtures = DB::table('fixtures')->get();

        foreach ($fixtures as $fixture) {
            // Parse the started_at value as America/Toronto time
            $torontoTime = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $fixture->started_at,
                'America/Toronto'
            );

            // Convert to UTC
            $utcTime = $torontoTime->setTimezone('UTC');

            // Update the fixture with the UTC time
            DB::table('fixtures')
                ->where('id', $fixture->id)
                ->update(['started_at' => $utcTime->format('Y-m-d H:i:s')]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert by converting UTC back to Toronto time
        $fixtures = DB::table('fixtures')->get();

        foreach ($fixtures as $fixture) {
            // Parse the started_at value as UTC time
            $utcTime = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $fixture->started_at,
                'UTC'
            );

            // Convert back to Toronto time
            $torontoTime = $utcTime->setTimezone('America/Toronto');

            // Update the fixture with the Toronto time
            DB::table('fixtures')
                ->where('id', $fixture->id)
                ->update(['started_at' => $torontoTime->format('Y-m-d H:i:s')]);
        }
    }
};
