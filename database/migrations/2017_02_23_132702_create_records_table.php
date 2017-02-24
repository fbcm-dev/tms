<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();

            $table->foreign('member_id')
                ->references('id')
                ->on('records');

            $table->enum('service_type', ['sunday-school', 'mid-morning', 'early', 'vesper', 'special', 'prayer-meeting']);
            $table->date('for_date');
            $table->string('status', 45);
            $table->float('tithe_amnt', 8, 2);
            $table->float('faith_amnt', 8, 2);
            $table->float('love_amnt', 8, 2);
            $table->tinyInteger('special_offering');
            $table->text('special_offering_details', 200);
            $table->string('encoded_by', 45);
            $table->date('encoded_at');
            $table->string('verified_by', 45);
            $table->date('verified_at');
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
        Schema::dropIfExists('records');
    }
}
