<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    //
    public function checkAvailableTime()
    {
    	$place_id = request('placeId');
    	$bookings = Booking::where('place_id', $place_id)->get();

    	$count = 10;
    	// dd($current_time);
    	$available_dates = [];
    	for ($i=0; $i <$count ; $i++) {
    		$date = Carbon::today()->day($i+1)->toDateTimeString();
    		// dd(strtotime($date));
    		foreach ($bookings as $booking) {
    			if(strtotime($booking->date) !== strtotime($date)){
    				// dd($booking->date.",".$date);
    				$available_dates[]['date'] = $date;
    			}
    		}
    	}
    	return $available_dates;

    }
}
