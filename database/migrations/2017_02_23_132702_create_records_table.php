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
                ->on('records')
                ->onDelete('cascade');

            $table->enum('service_type', ['sunday-school', 'mid-morning', 'early', 'vesper', 'special', 'prayer-meeting']);
            $table->date('for_date');
            $table->string('status', 45)
                ->nullable(false)
                ->change();

            $table->float('tithe_amnt', 8, 2)
                ->nullable(false)
                ->change();

            $table->float('faith_amnt', 8, 2)
                ->nullable(false)
                ->change();

            $table->float('love_amnt', 8, 2)
                ->nullable(false)
                ->change();

            $table->tinyInteger('special_offering');
            $table->text('special_offering_details', 200);

            $table->string('encoded_by', 45)
                ->nullable(false)
                ->change();

            $table->date('encoded_at')
                ->nullable(false)
                ->change();

            $table->string('verified_by', 45)
                ->nullable(false)
                ->change();

            $table->date('verified_at')
                ->nullable(false)
                ->change();
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
