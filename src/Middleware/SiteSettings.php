<?php

namespace Quyenvkbn\System\Middleware;

use Closure;
use View;
use Quyenvkbn\System\Models\System;
use Quyenvkbn\System\Models\CounterValues;
use Quyenvkbn\System\Models\CounterIps;

class SiteSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $site_settings = System::get()->pluck('content_'.session('locale'),'keyword');
        $request->site_settings = $site_settings;
        View::share('site_settings', $site_settings);
        
        // Thống kê truy cập
        $counter_expire = 300;
        $ignore = false; 

        $row = CounterValues::first();
        // fill when empty
        
        if (!$row)
        {     
            CounterValues::create([
                'id' => 1,
                'day_id' => date("z"),
                'day_value' => 1,
                'yesterday_id' => (date("z")-1),
                'yesterday_value' => 0,
                'week_id' => date("W"),
                'week_value' => 1,
                'month_id' => date("n"),
                'month_value' => 1,
                'year_id' => date("Y"),
                'year_value' => 1,
                'all_value' => 1,
                'record_date' => gmdate('Y-m-d H:i:s', time() + 7*3600),
                'record_value' => 1,
            ]);
            $row = CounterValues::first()->toArray();
            $ignore = true;
        }else{
            $row = $row->toArray();
        }
    
        $counter_agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? addslashes(trim($_SERVER['HTTP_USER_AGENT'])) : "";
        $counter_time = time();
        $counter_ip = trim(addslashes($_SERVER['REMOTE_ADDR'])); 

        // ignorore some bots
        if (substr_count($counter_agent, "bot") > 0)  {$ignore = true;}

        // delete free ips
        if ($ignore == false)
        {
            CounterIps::whereRaw("unix_timestamp(NOW())-unix_timestamp(visit) > $counter_expire")->delete();
        }
          
        // check for entry
        if ($ignore == false)
        {
            $res = CounterIps::where('ip', $counter_ip)->where('session', session_id())->count();
            if ($res == 0)
            {
                CounterIps::create([
                    'ip' => $counter_ip,
                    'visit' => NOW(),
                    'session' => session_id(),
                ]);
            }
            else
            {
                CounterIps::where('ip', $counter_ip)->where('session', session_id())->update([
                    'visit' => NOW()
                ]);
            }
        }

        // online?
        $online =  CounterIps::count();
        
          
        // add counter
        if ($ignore == false)
        {         
            // yesterday
            if ($row['day_id'] == (date("z")-1)) 
            {
                $row['yesterday_value'] = $row['day_value']; 
                $row['yesterday_id'] = (date("z")-1);
            }
            else
            {
                if ($row['yesterday_id'] != (date("z")-1))
                {
                    $row['yesterday_value'] = 0; 
                    $row['yesterday_id'] = date("z")-1;
                }
            }
            // day
            if ($row['day_id'] == date("z")) 
            {
                $row['day_value']++; 
            }
            else 
            {
                $row['day_value'] = 1;
                $row['day_id'] = date("z");
            }

            // week
            if ($row['week_id'] == date("W")) 
            {
                $row['week_value']++; 
            }
            else 
            { 
                $row['week_value'] = 1;
                $row['week_id'] = date("W");
            }

            // month
            if ($row['month_id'] == date("n")) 
            {
                $row['month_value']++; 
            }
            else 
            {
                $row['month_value'] = 1;
                $row['month_id'] = date("n");
            }

            // year
            if ($row['year_id'] == date("Y")) 
            {
                $row['year_value']++; 
            }
            else 
            {
                $row['year_value'] = 1;
                $row['year_id'] = date("Y");
            }

            // all
            $row['all_value']++;

            // neuer record?
            if ($row['day_value'] > $row['record_value'])
            {
                $row['record_value'] = $row['day_value'];
                $row['record_date'] = date("Y-m-d H:i:s");
            }

            CounterValues::where('id',1)->update($row);
        }

        session([
            'online' => $online,
            'counter_values' => $row,
        ]);

        return $next($request);
    }
}
