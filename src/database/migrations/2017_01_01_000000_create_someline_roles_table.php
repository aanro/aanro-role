<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSomelineRolesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        // Create table for storing roles
        Schema::create('entrust_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('entrust_user_roles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('user_id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('entrust_roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('entrust_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('entrust_role_permissions', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('entrust_permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('entrust_roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

//        Schema::create('someline_roles', function (Blueprint $table) {
//            $table->increments('someline_role_id');
//            $table->unsignedInteger('user_id')->index();
//
//            // Adding more table related fields here...
//            $table->string('title', 150);
//            $table->unsignedInteger('someline_image_id')->index()->nullable();
//            $table->text('body_html');
//            $table->text('body_text');
//            $table->timestamp('pinned_at')->nullable();
//
//            $table->unsignedInteger('created_by')->nullable();
//            $table->timestamp('created_at')->nullable();
//            $table->ipAddress('created_ip')->nullable();
//            $table->unsignedInteger('updated_by')->nullable();
//            $table->timestamp('updated_at')->nullable();
//            $table->ipAddress('updated_ip')->nullable();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('entrust_role_permissions');
        Schema::drop('entrust_permissions');
        Schema::drop('entrust_user_roles');
        Schema::drop('entrust_roles');
//        Schema::drop('someline_roles');
    }

}
