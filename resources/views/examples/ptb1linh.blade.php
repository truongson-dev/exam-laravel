<!doctype html>
<html lang="vi">

<head>
    <title>Giải PT & Bảng Tính</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Google Fonts cho thiết kế chuyên nghiệp -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <style>
        body {
            background-color: #f1f5f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .solver-container {
            width: 100%;
            max-width: 550px;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: #ffffff;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            border-radius: 16px;
            border: none;
            overflow: hidden;
        }

        .card-header-clean {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 24px 32px;
            text-align: center;
        }

        .card-header-clean h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            color: #1e293b;
        }

        .card-body-custom {
            padding: 32px;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #475569;
        }

        .input-professional {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 10px 15px;
            transition: all 0.2s;
        }

        .input-professional:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .result-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #d97706; /* Màu cam nổi bật cho kết quả */
            text-align: center;
        }

        .btn-custom {
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        
        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }
    </style>
</head>

<body>
    <div class="solver-container">
        <div class="card">
            <div class="card-header-clean">
                <h3>GIẢI PHƯƠNG TRÌNH & BẢNG TÍNH</h3>
            </div>
            
            <div class="card-body-custom">
                <!-- Hiển thị lỗi validation -->
                <div id="error-container">
                    @if ($errors->any())
                        <div class="alert alert-danger" style="border-radius: 8px;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <form method="post" action="/ptb1linh" id="mainForm">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="hsa" class="col-sm-4 col-form-label form-label">Số thứ nhất (a):</label>
                        <div class="col-sm-8">
                            <input type="text" name="hsa" id="hsa" value="{{ old('hsa', $a ?? '') }}"
                                class="form-control input-professional" placeholder="Nhập số a..." autofocus>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="hsb" class="col-sm-4 col-form-label form-label">Số thứ hai (b):</label>
                        <div class="col-sm-8">
                            <input type="text" name="hsb" id="hsb" value="{{ old('hsb', $b ?? '') }}"
                                class="form-control input-professional" placeholder="Nhập số b...">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Chức năng:</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="mode_pt" name="mode" value="ptb1" class="custom-control-input" 
                                {{ old('mode', $mode ?? 'ptb1') == 'ptb1' ? 'checked' : '' }} onchange="toggleCalc()">
                            <label class="custom-control-label" for="mode_pt">Giải phương trình (ax + b = 0)</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline mt-2 mt-md-0">
                            <input type="radio" id="mode_calc" name="mode" value="calc" class="custom-control-input" 
                                {{ old('mode', $mode ?? '') == 'calc' ? 'checked' : '' }} onchange="toggleCalc()">
                            <label class="custom-control-label" for="mode_calc">Bảng tính</label>
                        </div>
                    </div>

                    <!-- Phần chọn phép tính (Chỉ hiện khi chọn Bảng tính) -->
                    <div class="form-group p-3 mb-4" id="calc_ops" style="display: {{ old('mode', $mode ?? 'ptb1') == 'calc' ? 'block' : 'none' }}; background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label class="form-label">Phép tính:</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="operation" id="op_add" value="add" {{ old('operation', $operation ?? 'add') == 'add' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="op_add">Cộng</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="operation" id="op_sub" value="sub" {{ old('operation', $operation ?? '') == 'sub' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="op_sub">Trừ</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="operation" id="op_mul" value="mul" {{ old('operation', $operation ?? '') == 'mul' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="op_mul">Nhân</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="operation" id="op_div" value="div" {{ old('operation', $operation ?? '') == 'div' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="op_div">Chia</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block btn-custom">Thực hiện</button>
                        </div>
                        <div class="col-6">
                            <!-- Nút reset với type="button" để thực thi JS -->
                            <button type="button" class="btn btn-secondary btn-block btn-custom" onclick="resetForm()">Làm lại</button>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    <label class="form-label">Kết quả:</label>
                    <div id="ketqua" class="result-box shadow-sm">
                        {{ $kq ?? '---' }}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script xử lý giao diện -->
    <script>
        // Hàm ẩn/hiện bảng tính
        function toggleCalc() {
            var isCalcMode = document.getElementById('mode_calc').checked;
            var calcOps = document.getElementById('calc_ops');
            if(isCalcMode) {
                calcOps.style.display = 'block';
            } else {
                calcOps.style.display = 'none';
            }
        }

        // Hàm Reset dữ liệu trên giao diện
        function resetForm() {
            // Xóa rỗng các ô nhập
            document.getElementById('hsa').value = '';
            document.getElementById('hsb').value = '';
            
            // Xóa thông báo lỗi validation nếu có
            var errorContainer = document.getElementById('error-container');
            if (errorContainer) {
                errorContainer.innerHTML = '';
            }
            
            // Đặt lại kết quả về chuỗi rỗng
            document.getElementById('ketqua').innerHTML = '---';
            
            // Chọn mặc định là Giải Phương Trình
            document.getElementById('mode_pt').checked = true;
            toggleCalc(); // Ẩn div chọn phép tính
            
            // Đặt con trỏ (focus) vào ô số thứ nhất
            document.getElementById('hsa').focus();
        }
    </script>
</body>

</html>