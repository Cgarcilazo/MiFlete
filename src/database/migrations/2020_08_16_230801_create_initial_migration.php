<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInitialMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //User
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')
                ->nullable(false);
            $table->string('last_name')
                ->nullable(false);
            $table->string('email')
                ->nullable(false)
                ->unique();
            $table->string('password')
                ->nullable(false);
            $table->dateTime('dob')
                ->nullable();
            $table->boolean('active')
                ->nullable(false)
                ->default();
            $table->boolean('verified')
                ->nullable(false)
                ->default();
            $table->string('phone_number')
                ->nullable();
            $table->string('type')
                ->nullable(false);
            $table->softDeletes();
                $table->timestamp('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->nullable(false);
                $table->timestamp('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->nullable(false);
        });

        //Requests
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')
                ->nullable(false);
            $table->string('status')
                ->nullable(false);
            $table->longText('description')
                ->nullable();
            $table->string('origin')
                ->nullable(false);
            $table->string('destination')
                ->nullable(false);
            $table->dateTime('date')
                ->nullable(false);
            $table->softDeletes();
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->nullable(false);
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->nullable(false);
        });

        Schema::table('requests', function (Blueprint $table) {
            $table->integer('user_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        //Replies
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price', 8, 2)
                ->nullable(false);
            $table->string('status')
                ->nullable(false);
            $table->longText('description')
                ->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->nullable(false);
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->nullable(false);
        });

        Schema::table('replies', function (Blueprint $table) {
            $table->integer('user_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('request_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('request_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        //Interactions
        Schema::create('interactions', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description')
                ->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->nullable(false);
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->nullable(false);
        });

        Schema::table('interactions', function (Blueprint $table) {
            $table->integer('from_user_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('from_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('to_user_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('to_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('request_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('request_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('reply_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('reply_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        //Ratings
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rate')
                ->nullable(false);
            $table->longText('comment')
                ->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->nullable(false);
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->nullable(false);
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->integer('from_user_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('from_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('to_user_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('to_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('request_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('request_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('reply_id')
                ->nullable(false)
                ->unsigned();
            $table->foreign('reply_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('interactions');
        Schema::dropIfExists('replies');
        Schema::dropIfExists('requests');
        Schema::dropIfExists('users');
    }
}
