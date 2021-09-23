<?php

namespace App\Http\Controllers;

use App\Models\CC3CXTicket;

class CC3CXTicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
         $details = [
              'title' => 'Mail from ItSolutionStuff.com',
              'body' => 'This is for testing email using smtp'
         ];

         \Mail::to('sataporn.chn@gmail.com')->send(new \App\Mail\Sendmail($details));
         $data["status"] = 0;

         return json_encode($data);
    }

    public function store(Request $request)
    {
         $items = $request->items;
         // return json_encode($items);
         DB::beginTransaction();
         try {
              $data = [
                   'ticket_id' => $items["ticket_id"]
                   ,'ticket_no' => $items["ticket_no"]
                   ,'customer_id' => $items["customer_id"]
                   ,'customer_name' => $items["customer_name"]
                   ,'email' => $items["email"]
                   ,'subject' => $items["subject"]
                   ,'detail' => $items["detail"]
                   ,'created_by' => $items["created_by"]
                   ,'created_name' => $items["created_name"]
                   ,'created_at' => date('Y-m-d H:i:s')
              ];

              CC3CXTicket::insert($data);

              DB::commit();
              $return['status'] = "success";
         } catch (\Exception $e) {
              DB::rollBack();
              $return['status'] = "error";
         }
         return json_encode($return);
    }
}
