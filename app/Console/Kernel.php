<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Models\Booking;
use App\Models\User;
use App\Models\UserBusiness;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Services\PushNotificationService;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            $bookings=Booking::where('status','pending')->where('estimated_time','<',Carbon::now())->get();
            // \Log::debug(Carbon::today());
            foreach ($bookings as $key => $booking) {

                $business=UserBusiness::find($booking->user_business_id);
                $booking->status='droped';
                $booking->save();
                $token=User::find($booking->user_id)->device_token;
                $title='Booking Droped';
                $body='Alert! One of your booking has been droped.';
                // $token=$provider->device_token;
                $from_user=$business->user_id;
                $to_user=$booking->user_id;
                $type='BOOKING';
                // To Provider
                $noti=new PushNotificationService();
                $noti->send($title, $body,$token,$from_user,$to_user,$type);
                 // \Log::debug('wao');
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
