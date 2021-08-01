<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            for ($day = 1; $day <= 31; $day++) {
                $days[] = $day;
            }
            $table->id();
            $table->string('identifier');
            $table->foreignId('company_id')->constrained('companies');
            $table->enum('due_date', $days);
            $table->enum('closing_date', $days);
            $table->integer('processing_days');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
