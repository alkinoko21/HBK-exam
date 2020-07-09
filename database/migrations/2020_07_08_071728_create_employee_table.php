<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('employee')) {
            $this->down();
        }
        Schema::create('employee', function (Blueprint $table) {
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('emp_id');
            $table->string('fname',100);
            $table->string('lname',100);
            $table->foreignId('com_id');
            $table->foreign('com_id')->references('com_id')->on('company')->onDelete('cascade');;
            $table->string('email',150)->nullable()->unique();
            $table->string('phone',150)->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->index(['fname', 'lname']);
            $table->index(['fname', 'lname','com_id']);
            $table->index(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
