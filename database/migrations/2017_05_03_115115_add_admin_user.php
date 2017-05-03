<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use Carbon\Carbon;

class AddAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert some stuff
        DB::table('users')->insert(
            array(
                'email'             => 'checon_industry@yahoo.com',
                'auth_type'         => User::AUTH_TYPE_SUPER_ADMIN,
                'password'          => md5('password123123'),
                'first_name'        => 'admin',
                'last_name'         => 'admin',
                'contact_number'    => '',
                'address'           => '',
                'company'           => '',
                'is_active'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
