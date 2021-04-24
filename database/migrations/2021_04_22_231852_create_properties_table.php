<?php

    use App\Models\User;
    use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('sale')->nullable();
            $table->boolean('rent')->nullable();
            $table->integer('category');
            $table->integer('type');
//            $table->unsignedInteger('user_id');
            /** pricing and values */
            $table->decimal('sale_price',10)->nullable();
            $table->decimal('rent_price',10)->nullable();
            $table->decimal('tribute',10)->nullable();
            $table->decimal('condominium',10)->nullable();

            /** description */
            $table->text('description')->nullable();
            $table->integer('bedrooms')->default(0);
            $table->integer('suites')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->integer('rooms')->default(0);
            $table->integer('garage')->default(0);
            $table->integer('garage_covered')->default(0);
            $table->integer('area_total')->default(0);
            $table->integer('area_util')->default(0);

            /** address */
            $table->string('zipcode')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();

            /** structure */
            $table->boolean('air_conditioning')->nullable();
            $table->boolean('bar')->nullable();
            $table->boolean('library')->nullable();
            $table->boolean('barbecue_grill')->nullable();
            $table->boolean('american_kitchen')->nullable();
            $table->boolean('fitted_kitchen')->nullable();
            $table->boolean('pantry')->nullable();
            $table->boolean('edicule')->nullable();
            $table->boolean('office')->nullable();
            $table->boolean('bathtub')->nullable();
            $table->boolean('fireplace')->nullable();
            $table->boolean('lavatory')->nullable();
            $table->boolean('furnished')->nullable();
            $table->boolean('pool')->nullable();
            $table->boolean('steam_room')->nullable();
            $table->boolean('view_of_the_sea')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
