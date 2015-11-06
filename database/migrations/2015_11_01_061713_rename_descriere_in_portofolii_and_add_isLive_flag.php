<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameDescriereInPortofoliiAndAddIsLiveFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portofolii', function (Blueprint $table) {
            $table->renameColumn('descriere', 'description');
            $table->boolean('isActive')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portofolii', function (Blueprint $table) {
            $table->renameColumn('description', 'descriere');
            $table->boolean('isActive')->default(false);
        });
    }
}
