<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class EditRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('requests') && !Schema::hasColumn('requests', 'province_origin')) {
            Schema::table('requests', function (Blueprint $table) {
                $table->string('city_origin')
                    ->nullable(false)
                    ->default('');
                $table->string('city_destination')
                    ->nullable(false)
                    ->default('');
                $table->string('street_origin')
                    ->nullable(false)
                    ->default('');
                $table->string('street_destination')
                    ->nullable(false)
                    ->default('');
                $table->string('street_number_origin')
                    ->nullable(false)
                    ->default('');
                $table->string('street_number_destination')
                    ->nullable(false)
                    ->default('');
                $table->string('flat_number_origin')
                    ->nullable(false)
                    ->default('');
                $table->string('flat_number_destination')
                    ->nullable(false)
                    ->default('');
                $table->string('flat_letter_origin')
                    ->nullable(false)
                    ->default('');
                $table->string('flat_letter_destination')
                    ->nullable(false)
                    ->default('');
                $table->time('preferred_hour')
                    ->nullable(false);
                $table->time('range_hour_from')
                    ->nullable(true);
                $table->time('range_hour_to')
                    ->nullable(true);
                $table->boolean('need_more_carriers')
                    ->nullable(false)
                    ->default(false);
                $table->boolean('is_elevator_origin')
                    ->nullable(false)
                    ->default(false);
                $table->boolean('is_elevator_destination')
                    ->nullable(false)
                    ->default(false);
                $table->string('clarifications')
                    ->nullable(true);
            });

            Schema::table('requests', function (Blueprint $table) {
                $table->renameColumn('origin', 'province_origin');
            });

            Schema::table('requests', function (Blueprint $table) {
                $table->renameColumn('destination', 'province_destination');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('requests') && Schema::hasColumn('requests', 'city_origin')) {
            Schema::table('requests', function (Blueprint $table) {
                $table->dropColumn('city_origin');
                $table->dropColumn('city_destination');
                $table->dropColumn('street_origin');
                $table->dropColumn('street_destination');
                $table->dropColumn('street_number_origin');
                $table->dropColumn('street_number_destination');
                $table->dropColumn('flat_number_origin');
                $table->dropColumn('flat_number_destination');
                $table->dropColumn('flat_letter_origin');
                $table->dropColumn('flat_letter_destination');
                $table->dropColumn('preferred_hour');
                $table->dropColumn('range_hour_from');
                $table->dropColumn('range_hour_to');
                $table->dropColumn('need_more_carriers');
                $table->dropColumn('is_elevator_origin');
                $table->dropColumn('is_elevator_destination');
                $table->dropColumn('clarifications');
            });
        }

        if (Schema::hasColumn('requests', 'province_origin')) {
            Schema::table('requests', function (Blueprint $table) {
                $table->renameColumn('province_origin', 'origin');
                $table->renameColumn('province_destination', 'destination');
            });
        }
    }
}
