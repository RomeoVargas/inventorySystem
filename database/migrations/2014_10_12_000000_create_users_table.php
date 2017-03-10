<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', User::MAX_LENGTH_EMAIL)->unique();
            $table->tinyInteger('auth_type')->default(User::AUTH_TYPE_CUSTOMER);
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_number');
            $table->string('address');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('users')->insert(
            array(
                'email'             => 'admin@admin.com',
                'auth_type'         => User::AUTH_TYPE_ADMIN,
                'password'          => md5('password123123'),
                'first_name'        => 'admin',
                'last_name'         => 'admin',
                'contact_number'    => '',
                'address'           => '',
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
        Schema::dropIfExists('users');
    }
}
