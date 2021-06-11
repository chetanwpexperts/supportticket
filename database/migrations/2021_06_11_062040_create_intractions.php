<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intractions', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id')->nullable();
            $table->string('ticket_number')->nullable();
            $table->longtext('notes')->nullable();
            $table->longtext('internal_notes')->nullable();
            $table->integer('assignedTo')->nullable();
            $table->integer('assignedBy')->nullable();
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
        Schema::table('intractions', function (Blueprint $table) {
            //
        });
    }
}
