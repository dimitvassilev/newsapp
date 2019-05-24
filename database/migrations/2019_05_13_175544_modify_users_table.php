<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasColumn('users', 'active'))
        {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('active')->default(false);
            });
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('users', 'active'))
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('active');
            });
        }
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->change();
        });
    }
}
