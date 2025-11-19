<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CXS Cognitive Ability Assessment - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .main {
            height: 100%;
            /* min-height: 550px; */
            /* background-image: url("https://images.unsplash.com/photo-1533090161767-e6ffed986c88?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=869&q=80"); */
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            margin: auto;
            margin-top: 45px;
            margin-bottom: 45px;
        }

        .main__form {
            height: 100%;
            background-color: #fff;
            border-radius: 20px !important;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .main__form__inputs {
            height: 100%;
            display: flex;
            margin-bottom: 30px;
            flex-direction: column;
            justify-content: space-evenly;
            padding: 0 5%;
        }

        .main__form__inputs h3 {
            letter-spacing: 3.5px;
            font-size: 1.1rem;
            font-weight: normal;
            color: #343434;
            opacity: 80%;
        }

        .main__form__inputs div {
            height: 2.4rem;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            position: relative;
        }

        .main__form__inputs span {
            height: 2px;
            width: 0px;
            background: #1a7d9e;
            position: absolute;
            transition: width .8s;
        }

        .main__form__inputs div input {
            height: 100%;
            width: 100%;
            border: none;
            border-bottom: 1px solid #31416e;
            font-size: 1rem;
        }

        .main__form__inputs div input:focus {
            outline: none;
        }

        .main__form__inputs div input::placeholder {
            letter-spacing: 1px;
            font-size: .95rem;
        }

        #eye-icon {
            position: absolute;
            right: 1%;
            top: 30%;
            opacity: 80%;
            cursor: pointer;
            visibility: hidden;
        }

        .main__form__inputs a {
            text-decoration: none;
            align-self: center;
            color: #343434;
            letter-spacing: 1.5px;
            opacity: 85%;
            position: relative;
            overflow: hidden;
        }

        .main__form__inputs a:hover {
            color: #000;
            opacity: none;
        }

        /*BUTTONS*/

        .main__form__buttons {
            height: 15%;
            display: flex;
        }

        .main__form__buttons .button {
            height: 100%;
            flex-basis: 0;
            flex-grow: 1;
            border: none;
            font-size: .95rem;
            display: flex;
            align-items: center;
            /*add to the buttons display flex and justify content for use in span*/

        }

        .main__form__buttons .button:hover {
            cursor: pointer;
        }

        .main__form__buttons__btn1 {
            background: #4E4E4E;
            text-decoration: none;
            border: none;
            margin-top: 39px;
            border-radius: 9px;
            color: #fff;
        }

        .main__form__buttons__btn1:hover {
            background: #4E4E4E;
        }

        .main__form__buttons__btn2 {
            background: #CE9E20 !important;
            justify-content: end;
            border: none;
            margin-top: 39px;
            border-radius: 9px;
            color: #fff;
        }

        .main__form__buttons__btn2:hover {
            background: #CE9E20;
        }

        .main__form__buttons .button span {
            margin: 0 6%;
            letter-spacing: 2px;
        }

        .main__form__buttons__btn1 span {
            opacity: 80%;
        }


        /*BUTTONS*/


        /*mediaquerys*/

        @media screen and (max-width: 920px) {
            .main {
                padding: 6% 12%;
            }

            .main__form__inputs h3 {
                text-align: center;
            }
        }


        @media screen and (max-width: 500px) {
            .main {
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .main__form__buttons .button {
                justify-content: center;
            }

            .main__form {
                height: 360px;
                flex-basis: 85%;
            }

        }

        @media screen and (max-width: 250px) {
            html {
                font-size: 12px;
            }
        }

        .alert {
            font-size: 0.9rem !important;

        }

        .alert a {
            padding: 8px;
            color: #000;
            text-decoration-line: underline;

        }

        .font-20 {
            font-size: 20px !important;
        }

        .font-weight-bolder {
            font-weight: bolder !important;
        }
    </style>
</head>



<body>

    <div class="main col-lg-6">
        <form action="/login/submit" method="POST" class="main__form">
            @csrf
            <div class="main__form__inputs">
                <div class="mt-5 mb-3">
                    <img src="{{ asset('images/CXS-Full-Tight.png') }}" style="width: 190px">
                </div>


                <h3 class="text-center">Welcome to CXS Cognitive Ability Assessment</h3>
                @if (session('error'))
                    <div class="alert alert-danger align-items-center justify-content-start " role="alert">
                        Invalid Credentials! Please check credentials or register on <a href="mynext.my">Mynext </a>
                    </div>
                @endif
                <div class="mt-3 mb-3">
                    <input type="email" placeholder="EMAIL" name="email" class="email" value="{{ old('email') }}"
                        required id="input1">
                    <span id="span1"></span>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-3 mb-3">
                    <input type="password" name="password" placeholder="  PASSWORD" required id="input2">
                    <i class="fa-solid fa-eye" id="eye-icon"></i>
                    <span id="span2"></span>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-3 d-block mb-3">
                    <label for="">Select Language For Assessment</label>

                    <select class="form-select form-select-lg mb-3" name="language" aria-label="Large select example"
                        style="
                         border-radius: 44px;
                         " required>
                        <option value="en" selected>English</option>
                        <option value="my">Bahasa Melayu</option>
                    </select>

                    @error('language')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- <a href="#">FORGOT YOUR PASSWORD</a> --}}
            </div>

            <div class="d-flex justify-content-around">
                <a href="https://talent.mynext.my/" class="main__form__buttons__btn1 button p-3" id="register">
                    <span>REGISTER</span>
                </a>
                <button class="main__form__buttons__btn2 button p-3">
                    <span>SIGN IN</span>
                </button>
            </div>
            <p class="text-center bold font-20 font-weight-bolder mt-4">In collabration with</p>
            <div class="d-flex justify-content-center p-4">
                <img src="{{ asset('images/upsi-logo.png') }}" style="width: 190px">
            </div>
        </form>
    </div>
    <footer id="footer" class="static">
        <div class="site-footer px-6 bg-white  text-slate-500 fw-700 py-4 ">
            <div class="grid md:grid-cols-2 grid-cols-1 md:gap-5">
                <div class="text-center ltr:md:text-start rtl:md:text-right text-sm">
                    COPYRIGHT ©
                    <span id="thisYear">2023</span>
                    CXS Analytics, All rights Reserved
                </div>

            </div>
        </div>
    </footer>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script>
    const input1 = document.getElementById("input1");
    const input2 = document.getElementById("input2");
    const input3 = document.getElementById("input3");

    const span1 = document.getElementById("span1");
    const apan2 = document.getElementById("span2");

    input1.addEventListener("click", () => {
        span1.style.width = "100%"
    })
    input1.addEventListener("blur", () => {
        span1.style.width = "0"
    })

    input2.addEventListener("click", () => {
        span2.style.width = "100%"
    })
    input2.addEventListener("blur", () => {
        span2.style.width = "0"
    })

    // here begins the show the password

    const eyeIcon = document.getElementById("eye-icon");

    input2.addEventListener("input", () => {
        eyeIcon.style.visibility = "visible"
    })

    let flag = 0;
    eyeIcon.addEventListener("click", () => {

        if (flag == 0) {
            input2.type = "text";
            flag = 1;
            eyeIcon.setAttribute("class", "fa-solid fa-eye-slash")
        } else {
            input2.type = "password";
            flag = 0;
            eyeIcon.setAttribute("class", "fa-solid fa-eye")
        }

    })
</script>

</html>

make this html mobile responsive
