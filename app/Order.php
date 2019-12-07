<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    public function items()
    {
    	return $this->hasMany(OrderItem::class);
    }

    public function getTotal()
    {
    	$total = 0;
    	foreach ($this->items as $item) {
    		$total += ($item->price * $item->quantity);
    	}

    	return $total;
    }
}
