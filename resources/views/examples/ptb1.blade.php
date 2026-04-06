<!doctype html>
<html lang="en">

<head>
    <title>Giải Phương Trình Bậc Nhất - Professional</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Google Fonts: Inter for professional look -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-body: #f1f5f9;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --card-bg: #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .solver-container {
            width: 100%;
            max-width: 500px;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-professional {
            background: var(--card-bg);
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            overflow: hidden;
        }

        .card-header-clean {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 24px 32px;
        }

        .card-header-clean h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-main);
            letter-spacing: -0.025em;
        }

        .card-body-custom {
            padding: 32px;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .input-professional {
            display: block;
            width: 100%;
            padding: 12px 16px;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--text-main);
            background-color: #ffffff;
            background-clip: padding-box;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
        }

        .input-professional:focus {
            color: var(--text-main);
            background-color: #ffffff;
            border-color: var(--primary-color);
            outline: 0;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .btn-solve {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            background-color: var(--primary-color);
            color: #ffffff;
            font-weight: 600;
            padding: 14px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 8px;
        }

        .btn-solve:hover {
            background-color: var(--primary-hover);
            text-decoration: none;
            color: white;
        }

        .result-section {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }

        .result-title {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 12px;
        }

        .result-display {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-main);
            display: flex;
            align-items: center;
        }

        .result-display::before {
            content: "";
            display: block;
            width: 4px;
            height: 24px;
            background-color: var(--primary-color);
            border-radius: 2px;
            margin-right: 16px;
        }

        .footer-note {
            text-align: center;
            margin-top: 24px;
            font-size: 0.875rem;
            color: var(--text-muted);
        }
    </style>
</head>

<body>
    <div class="solver-container">
        <div class="card card-professional">
            <div class="card-header-clean">
                <h1>Giải Phương Trình Bậc Nhất</h1>
            </div>

            <div class="card-body-custom">
                <form action="{{ url('/ptb1') }}" method="POST">
                    @csrf

                    <div class="form-group mb-4">
                        <label class="form-label" for="hsa">Hệ số a</label>
                        <input type="number" step="any" name="txtA" id="hsa"
                            class="input-professional @error('txtA') is-invalid @enderror"
                            placeholder="Nhập giá trị của a" value="{{ old('txtA', $a ?? '') }}" required autofocus>

                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label" for="hsb">Hệ số b</label>
                        <input type="number" step="any" name="txtB" id="hsb"
                            class="input-professional @error('txtB') is-invalid @enderror"
                            placeholder="Nhập giá trị của b" value="{{ old('txtB', $b ?? '') }}" required>
                    </div>


                    <div class="form-group mb-4">
                        <label class="form-label">Chọn phép toán</label>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="op_cong" name="operation" value="add"
                                    class="custom-control-input" @checked(($operation ?? 'add') == 'add')>
                                <label class="custom-control-label" for="op_cong">Cộng</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="op_tru" name="operation" value="sub"
                                    class="custom-control-input" @checked(($operation ?? '') == 'sub')>
                                <label class="custom-control-label" for="op_tru">Trừ</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="op_nhan" name="operation" value="mul"
                                    class="custom-control-input" @checked(($operation ?? '') == 'mul')>
                                <label class="custom-control-label" for="op_nhan">Nhân</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="op_chia" name="operation" value="div"
                                    class="custom-control-input" @checked(($operation ?? '') == 'div')>
                                <label class="custom-control-label" for="op_chia">Chia</label>
                            </div>

                        </div>
                    </div>

                    <div class="row no-gutters">
                        <div class="col-4 pr-1">
                            <button type="submit" name="btnGiai" id="btnGiai" class="btn-solve">
                                Giải PTB1
                            </button>
                        </div>
                        <div class="col-4 px-1">
                            <button type="submit" name="btnTinh" id="btnTinh" class="btn-solve"
                                style="background-color: #64748b;">
                                Tính toán
                            </button>
                        </div>
                        <div class="col-4 pl-1">
                            <a href="{{ url('/ptb1') }}" class="btn-solve"
                                style="background-color: #ef4444; text-decoration: none;">
                                Reset
                            </a>
                        </div>
                    </div>

                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3" style="border-radius: 12px;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @isset($result)

                    <div class="result-section">
                        <div class="result-title">Kết quả phân tích</div>
                        <div class="result-display">
                            {{ $result }}
                        </div>
                    </div>
                @endisset
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>