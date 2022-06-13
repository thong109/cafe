<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\TableInfor;
use App\Models\TableStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TableController extends Controller
{
    public function table()
    {
        $getTableStatus = TableStatus::all();
        $getTable = TableInfor::with('getStatus')->get();
        $getIdTable = TableInfor::select('id')->get();
        // $getTableInfor = TableInfor::get();
        // $TableId = Table::select('id')->get();
        return view('admin.table.tableIndex', compact('getTable', 'getTableStatus','getIdTable'));
    }
    public function addTable(Request $request)
    {
        $data = array();
        // $lastTable = Table::orderBy('id', 'desc')->first();
        $data['times'] = $request->times;
        if ($data['times'] > 0) {
            for ($i = 1; $i <= $data['times']; $i++) {
                $addTable = new TableInfor();
                $addTable->name = "bàn" . ' ' . $i;
                $addTable->save();
            }
            // return Redirect::to('table')->with('message', 'Thêm bàn thành công');
        }
        // elseif ($lastTable) {
        //     for ($j = $lastTable->number; $j <= $data['times']; $j++) {
        //         $addTableLast = new Table();
        //         $addTableLast->number = $j;
        //         $addTableLast->save();
        //     }
        //     return Redirect::to('table')->with('message', 'Thêm bàn thành công 2');
        // }
        // else {
        //     return Redirect::to('table')->with('message', 'Thêm bàn thất bại');
        // }
    }
    public function creatTable(Request $request)
    {
        if ($request->type == 2) { // đặt theo status table
            $getIdTable = TableInfor::where('id', $request->id)->first();
            // dd($request->$request->id);
            $getIdTable->reservation_date = $request->reservation_date;
            $getIdTable->reservation_time = $request->reservation_time;
            $getIdTable->customer_name = $request->customer_name;
            $getIdTable->customer_phone = $request->customer_phone;
            $getIdTable->type = $request->type;
            if (!$request->customer_email) {
                $getIdTable->customer_email = null;
            } else {
                $getIdTable->customer_email = $request->customer_email;
            }
            $getIdTable->save();
        }
    }
    // public function tablePage()
    // {
    //     $getTableStatus = TableStatus::get();
    //     $getTable = TableInfor::get();
    //     $output = '';
    //     $output .= '
    //         <div class="table-responsive d-flex mt-2">
    //             <div class="flex">
    //     ';
    //     foreach ($getTable as $table) {
    //         $output .= '
    //         <button type="button" class="btn btn-primary chair" data-bs-toggle="modal"
    //                         data-bs-target="#exampleModal' . $table->id . '"
    //                         ';
    //         $output .= '">
    //             <span style="color: #000"> ' . $table->name . '</span>
    //             <input type="hidden" value="' . $table->id . '">
    //         </button>';
    //         $output .= '
    //         <div class="modal fade" id="exampleModal' . $table->id . '" tabindex="-1"
    //                         aria-labelledby="exampleModalLabel" aria-hidden="true">
    //                         <div class="modal-dialog">
    //                             <div class="modal-content">
    //                                 <div class="modal-header">
    //                                     <h5 class="modal-title" id="exampleModalLabel">Chọn trạng thái bàn</h5>
    //                                     <button type="button" class="btn-close" data-bs-dismiss="modal"
    //                                         aria-label="Close"></button>
    //                                 </div>
    //                                 <form action="" method="post" autocomplete="off" id="insert_table">
    //                                 ' . csrf_field() . '
    //                                     <div class="modal-body">
    //                                         <select name="type"
    //                                             class="form-control input-lg m-bot15 mb-2 select type_' . $table->id . '">';
    //         foreach ($getTableStatus as $key) {
    //             if ($key->id == $key->id) {
    //                 $output .= '<option value="' . $key->id . '">' . $key->name . '</option>';
    //             } else {
    //                 $output .= '<option value="' . $key->id . '">' . $key->name . '</option>';
    //             }
    //             $output .= '
    //                                         </select>
    //                                         <div class="hide-1" id="reserved">
    //                                             <div class="form-floating mb-2">
    //                                                 <input type="date"
    //                                                     class="form-control reservation_date_' . $table->id . '"
    //                                                     name="reservation_date" id="floatingInput txtDate ">
    //                                                 <label for="floatingInput">Ngày đặt</label>
    //                                             </div>
    //                                             <div class="form-floating mb-2">
    //                                                 <input type="time"
    //                                                     class="form-control reservation_time_' . $table->id . '"
    //                                                     name="reservation_time" id="floatingTime ">
    //                                                 <label for="floatingTime">Thời gian</label>
    //                                             </div>
    //                                             <div class="form-floating mb-2">
    //                                                 <input type="text"
    //                                                     class="form-control customer_name_' . $table->id . '"
    //                                                     name="customer_name" id="floatingInput " placeholder="Name">
    //                                                 <label for="floatingInput">Tên người đặt</label>
    //                                             </div>
    //                                             <div class="form-floating mb-2">
    //                                                 <input type="text"
    //                                                     class="form-control customer_phone_' . $table->id . '"
    //                                                     name="customer_phone" id="floatingInput " placeholder="Phone">
    //                                                 <label for="floatingInput">Số điện thoại</label>
    //                                             </div>
    //                                             <div class="form-floating mb-2">
    //                                                 <input type="mail"
    //                                                     class="form-control customer_email_' . $table->id . '"
    //                                                     name="customer_email" id="floatingInput " placeholder="Email">
    //                                                 <label for="floatingInput">Email</label>
    //                                             </div>
    //                                             <div class="modal-footer">
    //                                                 <button type="button" class="btn btn-secondary"
    //                                                     data-bs-dismiss="modal">Đóng</button>
    //                                                 <input type="button" class="btn btn-primary"
    //                                                     data-id_table="' . $table->id . '" value="Lưu"
    //                                                     id="saveTableInfor">
    //                                             </div>
    //                                         </div>
    //                                         <div class="hide-1" id="using">
    //                                             abc
    //                                         </div>
    //                                     </div>
    //                                 </form>
    //                             </div>
    //                             </div>

    //                             </div>

    //                             </div>

    //                             ';
    //         }
    //         $output .= '
    //                         </div>
    //                     </div>
    //         ';
    //     }
    //     echo $output;
    // }
}
