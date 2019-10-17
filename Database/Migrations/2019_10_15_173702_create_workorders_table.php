<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(strtolower('workorders'), function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('account_id')->index();
            $table->unsignedInteger('client_id')->index();
            $table->date("work_order_date");
            $table->string('synopsis', 80);
            $table->string('problem_description');
            $table->string('resolution');

            $table->timestamps();
            $table->softDeletes();
            $table->boolean('is_deleted')->default(false);

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->unsignedInteger('public_id')->index();
            $table->unique( ['account_id', 'public_id'] );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(strtolower('workorders'));
    }
}
