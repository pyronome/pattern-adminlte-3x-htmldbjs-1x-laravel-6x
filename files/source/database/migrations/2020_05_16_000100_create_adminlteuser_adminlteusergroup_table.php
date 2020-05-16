<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLTEUserAdminLTEUserGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adminlteusertable', function(Blueprint $table) {
            if (!Schema::hasColumn('adminlteusertable', 'adminlteusergroup_id')) {
                $table->unsignedBigInteger('adminlteusergroup_id')->default(0);
            	$table->foreign('adminlteusergroup_id')->references('id')->on('adminlteusergrouptable');
			}                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adminlteusertable', function(Blueprint $table) {
            
        });
    }
}