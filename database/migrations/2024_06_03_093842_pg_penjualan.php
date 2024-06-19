<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pg_penjualan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_penjualan');
            $table->string('masked_card', 100)->nullable();
            $table->string('approval_code', 100)->nullable();
            $table->string('bank', 100)->nullable();
            $table->string('eci', 100)->nullable();
            $table->string('channel_response_code', 100)->nullable();
            $table->string('channel_response_message', 100)->nullable();
            $table->string('transaction_time', 100)->nullable();
            $table->string('gross_amount', 100)->nullable();
            $table->string('currency', 100)->nullable();
            $table->string('order_id', 100)->nullable();
            $table->string('payment_type', 100)->nullable();
            $table->string('signature_key', 128)->nullable();
            $table->string('status_code', 100)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->string('transaction_status', 100)->nullable();
            $table->string('fraud_status', 100)->nullable();
            $table->dateTime('settlement_time')->nullable();
            $table->string('status_message', 100)->nullable();
            $table->string('merchant_id', 100)->nullable();
            $table->string('card_type', 100)->nullable();
            $table->timestamps();
        });

        DB::table('pg_penjualan')->insert([
            'id_penjualan' => 7,
            'masked_card' => null,
            'approval_code' => null,
            'bank' => null,
            'eci' => null,
            'channel_response_code' => null,
            'channel_response_message' => null,
            'transaction_time' => '2024-03-31 13:22:11',
            'gross_amount' => '216000.00',
            'currency' => null,
            'order_id' => '1066873484',
            'payment_type' => 'bank_transfer',
            'signature_key' => null,
            'status_code' => '200',
            'transaction_id' => 'ae503fab-1fa1-456a-8088-1d68b9ae0b96',
            'transaction_status' => 'settlement',
            'fraud_status' => null,
            'settlement_time' => '2024-03-31 13:23:48',
            'status_message' => 'Success, transaction is found',
            'merchant_id' => 'G983754056',
            'card_type' => null
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pg_penjualan');
    }
};