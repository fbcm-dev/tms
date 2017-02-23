<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 45)
                ->nullable(false)
                ->change();

            $table->string('middle_name', 45);
            $table->string('last_name', 45)
                ->nullable(false)
                ->change();

            $table->string('address', 100)
                ->nullable(false)
                ->change();

            $table->date('birthday')
                ->nullable(false)
                ->change();

            $table->integer('age');
            $table->string('email', 45)
                ->nullable(false)
                ->change();

            $table->mediumText('contacts');
            $table->string('organization', 45);
            $table->integer('created_by')->unsigned();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
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
        Schema::dropIfExists('members');
    }
}
