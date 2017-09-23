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
                ->on('members');

            $table->enum('service_type', ['sunday-school', 'mid-morning', 'early', 'vesper', 'special', 'prayer-meeting']);
            $table->date('for_date');
            $table->string('status', 45)->default('unverified');
            $table->float('tithe_amnt', 8, 2)->nullable();
            $table->float('faith_amnt', 8, 2)->nullable();
            $table->float('love_amnt', 8, 2)->nullable();
            $table->tinyInteger('special_offering')->nullable();
            $table->text('special_offering_details', 200)->nullable();
            $table->string('encoded_by', 45)->nullable();
            $table->date('encoded_at')->nullable();
            $table->string('verified_by', 45)->nullable();
            $table->date('verified_at')->nullable();
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
