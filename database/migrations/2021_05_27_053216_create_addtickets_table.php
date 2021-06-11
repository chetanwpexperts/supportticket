<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addtickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->nullable();
            $table->string('order_number')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('customer_type')->nullable();
            $table->integer('product_id')->nullable();
            $table->longtext('subject')->nullable();
            $table->longtext('notes')->nullable();
            $table->integer('department_id')->nullable();
            $table->longtext('internal_notes')->nullable();
            $table->integer('is_archived')->nullable();
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
        
        Schema::table('addtickets', function(Blueprint $table) {
            $table->dropColumn('is_archived');
        });
        
        Schema::dropIfExists('addtickets');
    }
}
