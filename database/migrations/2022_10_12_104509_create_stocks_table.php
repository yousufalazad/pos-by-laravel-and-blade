<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(1);
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Supplier::class)->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Customer::class)->nullable()->constrained()->cascadeOnUpdate();
            
            $table->integer('in_quantity')->nullable();
            $table->decimal('in_unit_price', 15, 2)->nullable();
            $table->decimal('in_total_amount', 15, 2)->nullable();
            $table->decimal('in_discount_amount', 15, 2)->nullable();

            $table->integer('out_quantity')->nullable();
            $table->decimal('out_unit_price', 15, 2)->nullable();
            $table->decimal('out_ws_unit_price', 15, 2)->nullable();
            $table->decimal('out_total_amount', 15, 2)->nullable();
            $table->decimal('out_discount_amount', 15, 2)->nullable();

            $table->string('invoice')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
