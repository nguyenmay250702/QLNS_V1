<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login TMQ</title>

    <!-- fontawesome-icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- font chữ -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;600;700&display=swap" rel="stylesheet">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>

    {{-- <link rel="stylesheet" href="{{ asset('css/create.css') }}">  --}}

</head>

<body>
    <section>
        <div class="px-4 py-5 px-md-5 text-center min-vh-100 text-lg-start d-flex align-items-center"
            style="background-color: hsl(223.75deg 44.64% 12.74%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight" style="color: hsl(0deg 0% 85.83%)">
                            Chào mừng đến với <br />
                            <span style="color: #87000c">TMQ</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Được thành lập từ năm…..  cho đến nay công ty chúng tôi đã ngày càng phát triển, ngày càng được khách hàng ưa chuộng. Trong thời gian sắp tới công ty đang phấn đấu để hoàn thiện mục tiêu sẽ trở thành một trong số những công ty đi đầu về ngành dịch vụ……    
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <form method="post" action="{{ route('authLogin') }}">
                                    @csrf
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3">Tên đăng nhập</label>
                                        <input type="text" id="form3Example3" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"/>
                                        <div class="text-danger"><?php echo $errors->first('username'); ?></div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4">Mật khẩu</label>
                                        <input type="password" id="form3Example4" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"/>
                                        <div class="text-danger"><?php echo $errors->first('password'); ?></div>
                                    </div>

                                    {{-- <div class="form-check mb-4">
                                        <input class="form-check-input me-2" type="checkbox" value=""
                                            id="form2Example33" name="savePass"/>
                                        <label class="form-check-label" for="form2Example33"> lưu mật khẩu </label>
                                    </div> --}}

                                    <div class="text-danger <?php if($errors->has('wrong_information')) echo 'mb-4'; ?>">
                                        <?php echo $errors->first('wrong_information'); ?>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block mb-4"> Đăng nhập </button>

                                    <!-- Register buttons -->
                                    <div class="text-center">
                                        <p>Thông tin liên hệ:</p>
                                        <a href="https://www.facebook.com/daihocthuyloi1959" target="_blank"
                                            class="text-decoration-none d-inline-block w-fit-content h-fit-content mx-2">
                                            <button type="button" class="btn btn-link btn-floating">
                                                <i class="fab fa-facebook-f"></i>
                                            </button>
                                        </a>
                                        <a href="https://www.tlu.edu.vn/" target="_blank"
                                            class="text-decoration-none d-inline-block w-fit-content h-fit-content mx-2">
                                            <button type="button" class="btn btn-link btn-floating">
                                                <i class="fab fa-google"></i>
                                            </button>
                                        </a>

                                        <a href="https://github.com/" target="_blank"
                                            class="text-decoration-none d-inline-block w-fit-content h-fit-content mx-2">
                                            <button type="button" class="btn btn-link btn-floating">
                                                <i class="fab fa-github"></i>
                                            </button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
