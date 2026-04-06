<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ptb1Controller extends Controller
{
    /**
     * Hiển thị trang giải phương trình và tính toán
     */
    public function showPtb1()
    {
        return view('examples.ptb1');
    }

    /**
     * Xử lý giải phương trình và tính toán
     */
    public function giaiPtb1(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'txtA' => 'required|numeric',
            'txtB' => 'required|numeric',
        ], [
            'txtA.required' => 'Hệ số a không được để trống.',
            'txtA.numeric' => 'Hệ số a phải là số.',
            'txtB.required' => 'Hệ số b không được để trống.',
            'txtB.numeric' => 'Hệ số b phải là số.',
        ]);

        // Sử dụng Request lớp để lấy dữ liệu
        $a = $request->input('txtA');
        $b = $request->input('txtB');
        $result = "";


        // Nút 'Giải PTB1' được nhấn
        if ($request->has('btnGiai')) {
            if ($a == 0) {
                if ($b == 0) {
                    $result = "Phương trình có vô số nghiệm.";
                } else {
                    $result = "Phương trình vô nghiệm.";
                }
            } else {
                $x = -$b / $a;
                $formatted_x = number_format($x, 2);
                $result = "Nghiệm của phương trình là: x = $formatted_x";
            }
        }

        // Nút 'Tính toán' được nhấn
        elseif ($request->has('btnTinh')) {
            $operation = $request->input('operation');

            switch ($operation) {
                case 'add':
                    $val = $a + $b;
                    $result = "Tổng: $a + $b = " . number_format($val, 2);
                    break;
                case 'sub':
                    $val = $a - $b;
                    $result = "Hiệu: $a - $b = " . number_format($val, 2);
                    break;
                case 'mul':
                    $val = $a * $b;
                    $result = "Tích: $a * $b = " . number_format($val, 2);
                    break;
                case 'div':
                    if ($b != 0) {
                        $val = $a / $b;
                        $result = "Thương: $a / $b = " . number_format($val, 2);
                    } else {
                        $result = "Lỗi: Không thể chia cho 0";
                    }
                    break;
                default:
                    $result = "Vui lòng chọn phép toán.";
            }
        }


        $operation = $request->input('operation', 'add');

        // Trả về view kèm dữ liệu
        return view('examples.ptb1', compact('a', 'b', 'result', 'operation'));
    }
}


