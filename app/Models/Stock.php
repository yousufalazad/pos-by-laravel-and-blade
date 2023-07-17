<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = ['type', 'user_id', 'product_id', 'supplier_id', 'customer_id', 'in_quantity', 'in_unit_price', 'in_total_amount','in_discount_amount', 'out_quantity', 'out_unit_price', 'out_ws_unit_price', 'out_total_amount', 'out_discount_amount', 'invoice', 'date',];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
