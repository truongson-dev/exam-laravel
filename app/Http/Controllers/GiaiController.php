<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiaiController extends Controller
{
    //-----show giao diện giải ptb1linh------
    function showPtb1Linh()
    {
        return view('examples.ptb1linh');
    }

    //-----Xử lý giải ptb1linh---------
    function giaiPtb1Linh(Request $request)
    {
        // validate dữ liệu đầu vào (Kiểm tra tính hợp lệ của dữ liệu)
        $request->validate([
            'hsa' => 'required|numeric',
            'hsb' => 'required|numeric',
        ], [
            'hsa.required' => 'Hệ số a / Số thứ nhất không được để trống.',
            'hsa.numeric' => 'Hệ số a / Số thứ nhất phải là một số hợp lệ.',
            'hsb.required' => 'Hệ số b / Số thứ hai không được để trống.',
            'hsb.numeric' => 'Hệ số b / Số thứ hai phải là một số hợp lệ.',
        ]);

        $a = $request->input('hsa');
        $b = $request->input('hsb');
        $mode = $request->input('mode', 'ptb1');
        $operation = $request->input('operation', 'add');
        
        $kq = "";

        // Giải phương trình bậc nhất
        if ($mode == 'ptb1') {
            if ($a == 0) {
                if ($b == 0) {
                    $kq = "Phương trình có vô số nghiệm.";
                } else {
                    $kq = "Phương trình vô nghiệm.";
                }
            } else {
                $x = -$b / $a;
                $kq = "Nghiệm của phương trình là: x = " . number_format($x, 2);
            }
        } 
        // Bảng tính
        else {
            switch ($operation) {
                case 'add':
                    $kq = "Kết quả phép cộng: $a + $b = " . ($a + $b);
                    break;
                case 'sub':
                    $kq = "Kết quả phép trừ: $a - $b = " . ($a - $b);
                    break;
                case 'mul':
                    $kq = "Kết quả phép nhân: $a * $b = " . ($a * $b);
                    break;
                case 'div':
                    if ($b == 0) {
                        $kq = "Lỗi: Không thể chia cho 0.";
                    } else {
                        $val = $a / $b;
                        $kq = "Kết quả phép chia: $a / $b = " . number_format($val, 2);
                    }
                    break;
            }
        }

        return view('examples.ptb1linh', compact('a', 'b', 'kq', 'mode', 'operation'));
    }
}
