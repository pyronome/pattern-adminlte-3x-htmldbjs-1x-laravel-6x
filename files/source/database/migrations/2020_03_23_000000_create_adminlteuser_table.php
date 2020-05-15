<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/* {{snippet:begin_class}} */

class CreateAdminLTEUserTable extends Migration
{

    /* {{snippet:begin_properties}} */

    /* {{snippet:end_properties}} */

    /* {{snippet:begin_methods}} */

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /* {{snippet:begin_up_method}} */

        Schema::create('adminlteusertable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->boolean('deleted')->default(0);
            $table->bigInteger('adminlteusergroup_id', false, true);
            $table->boolean('enabled')->default(0);
            $table->string('fullname')->nullable();;
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable();;
            $table->text('menu_permission')->nullable();;
            $table->text('service_permission')->nullable();;
        });

        DB::table('adminlteusertable')->insert(
            array(
                'id' => 1,
                'deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'adminlteusergroup_id' => 0,
                'enabled' => 1,
                'fullname' => 'AdminLTE Root',
                'username' => 'root',
                'email' => 'root',
                'password' => bcrypt('adminlte'),
                'menu_permission' => '',
                'service_permission' => ''
            )
        );

        /* {{snippet:end_up_method}} */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        /* {{snippet:begin_down_method}} */

        Schema::dropIfExists('adminlteusertable');

        /* {{snippet:end_down_method}} */

    }

    /* {{snippet:end_methods}} */

}

    /* {{snippet:end_class}} */
