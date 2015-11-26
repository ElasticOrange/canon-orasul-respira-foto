<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserProfileToProfileIdAddIsActiveForVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->renameColumn('user_profile', 'profile_id');
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
        Schema::table('votes', function (Blueprint $table) {
            $table->renameColumn('profile_id', 'user_profile');
            $table->dropColumn(
                'is_Active'
            );
        });
    }
}
