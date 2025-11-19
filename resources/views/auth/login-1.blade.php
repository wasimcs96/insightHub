<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="{{ asset('images/CXS-Logo.png') }}" type="image/x-icon">

<title>CXS Cognitive Ability Assessment - Login</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


<style>
        body {
        color: #999;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
	}
	.form-control {
		box-shadow: none;
		border-color: #ddd;
	}
	.form-control:focus {
		border-color: #CE9E20;
	}
	.login-form {
        width: 350px;
		margin: 0 auto;
		padding: 30px 0;
	}
    .login-form form {
        color: #434343;
		border-radius: 1px;
    	margin-bottom: 15px;
        background: #fff;
		border: 1px solid #ce9e20;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
	}
	.login-form h4 {
		text-align: center;
		font-size: 22px;
        margin-bottom: 20px;
	}
    .login-form .avatar {
        color: #fff;
		margin: 0 auto 27px;
        text-align: center;
		width: 100px;
		height: 100px;
		border-radius: 50%;
		z-index: 9;
		/* background: #CE9E20; */
		padding: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
    .login-form .avatar i {
        font-size: 62px;
    }
    .login-form .form-group {
        margin-bottom: 20px;
    }
	.login-form .form-control, .login-form .btn {
		min-height: 40px;
		border-radius: 2px;
        transition: all 0.5s;
	}
	.login-form .close {
        position: absolute;
		top: 15px;
		right: 15px;
	}
	.login-form .btn {
		background: #CE9E20;
		border: none;
		line-height: normal;
	}
	.login-form .btn:hover, .login-form .btn:focus {
		background: #0245A3;
	}
    .login-form .checkbox-inline {
        float: left;
    }
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .forgot-link {
        float: right;
    }
    .login-form .small {
        font-size: 13px;
    }
    .login-form a {
        color: #CE9E20;
    }
    .colab-text{
        font-weight:bolder;
        font-size:14px;
        color: black;
    }
    .py-4 {
    padding-top: 1rem;
    padding-bottom: 1rem;
}
.px-6 {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}
.bg-white {
    --tw-bg-opacity: 1;
    background-color: rgb(255 255 255 / var(--tw-bg-opacity));
}
.font-12{
font-size: 12px;
}
footer{
    position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
<body>
<!--  Request me for a signup form or any type of help  -->
<div class="login-form">
    <form  action="/login/submit" method="POST">
        @csrf
		<div class="avatar"> <img src="{{asset('images/CXS-Full-Tight.png')}}" style="width: 190px"></div>
    	<h4 class="modal-title" id="main-title">Welcome to Chrome</h4>
        @if (session('error'))
        <div class="alert alert-danger align-items-center justify-content-start " role="alert">
            Invalid Credentials! Please check credentials or register on <a href="https://talent.mynext.my/" target="_blank">Mynext </a>
          </div>
          @endif
        <div class="form-group">
            <input class="form-control" type="email" placeholder="Email" name="email" value="{{ old('email') }}"  required="required" style="
            border-radius: 44px;
            " id="email">
             @error('username')
             <div class="invalid-feedback">
                 {{ $message }}
             </div>
         @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password"required  class="form-control" placeholder="Password" required="required" style="
            border-radius: 44px;
            " id="password">
              @error('password')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror

        </div>
        {{-- <div class="mt-3 d-block mb-3 form-group">
            <label for="" id="languageLabel">Select language for assessment</label>

                <select  class="form-control" name="language" id="language" aria-label="Large select example" style="
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
            </div> --}}

        <input type="submit" class="btn btn-primary btn-block btn-lg" id="loginBtn" value="Login">
        <div class="text-center small" id="signuplabel">Don't have an account? <a href="https://talent.mynext.my/" target="_blank">Sign up</a></div>


    </form>
        {{-- <p class="text-dark font-12 " id="instruction"><b>Instruction:</b><span>The Cognitive Ability Assessment consists of 50 questions. There are four domains, namely quantitative knowledge, comprehension knowledge, visual reasoning, and fluid reasoning, each with three levels of difficulty: easy, moderate, and difficult, with four choices of answers. You are required to answer all questions. At the end of the assessment, you will know your cognitive ability level, whether it is low, medium, or high.</span></p>
        <div class="text-center small"> <p class="text-center colab-text  mt-4" id="collabration">In collabration with</p>
            <div class="d-flex justify-content-center p-4">
                   <img src="{{asset('images/upsi-logo.png')}}" style="width: 190px">
                </div></div> --}}


</div>
<footer id="footer" class="static">
    <div class="site-footer px-6 bg-white  text-slate-500 fw-700 py-4 ">
        <div class="grid md:grid-cols-2 grid-cols-1 md:gap-5">
            <div class="text-center colab-text text-sm" id="copyright">
                {{__("COPYRIGHT")}} ©
                <span id="thisYear">2024</span>
                {{ __("CXS Analytics, All rights Reserved") }}
            </div>

        </div>
    </div>
</footer>


<script>
    // Get references to the select element and the result div
    const selectElement = document.getElementById('language');
    const resultDiv = document.getElementById('instruction');
    const titleDiv = document.getElementById('main-title');
    const loginBtn = document.getElementById('loginBtn');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const languageLabel = document.getElementById('languageLabel');
    const signupLabel = document.getElementById('signuplabel');
    const collabrationLabel = document.getElementById('collabration');
    const copyrightDiv = document.getElementById('copyright');
    // Add an event listener to the select element
    selectElement.addEventListener('change', function () {
        // Get the selected option's value and text
        const selectedValue = this.value;

        const selectedText = this.options[this.selectedIndex].text;

        // Update the text of the result div
        if(selectedValue == 'my'){
            resultDiv.innerHTML  = `<b>Arahan:</b><span>Penilaian Keupayaan Kognitif mengandungi 50 soalan. Terdapat empat domain iaitu domain pengetahuan kuantitatif, pengetahuan kefahaman, penaakulan visual dan penaakulan bendalir dan setiap satunya mempunyai tiga aras kesukaran iaitu aras mudah, sederhana dan sukar serta empat pilihan jawapan. Anda dikehendaki menjawab semua soalan. Pada akhir penilaian ini, anda akan mengetahui tahap keupayaan kognitif anda sama ada berada pada tahap rendah, pertengahan atau tinggi.</span>`;
            titleDiv.innerHTML = `Selamat Datang ke Penilaian Keupayaan Kognitif CXS`;
            loginBtn.value = `Log Masuk`;
            email.placeholder = `Emel`;
            password.placeholder = `Kata Laluan`;
            languageLabel.innerHTML = `Pilih bahasa untuk penilaian`;
            signupLabel.innerHTML = `Tiada akaun? <a href="https://talent.mynext.my/" target="_blank" id="signupBtn">Daftar</a>`;
            collabrationLabel.innerHTML = `Dengan kerjasama`;
            copyrightDiv.innerHTML = `HAK CIPTA © <span id="thisYear">2023</span> CXS Analytics, Hak Cipta Terpelihara`;
        }else{
            resultDiv.innerHTML  = `<b>Instruction:</b><span>The Cognitive Ability Assessment consists of 50 questions. There are four domains, namely quantitative knowledge, comprehension knowledge, visual reasoning, and fluid reasoning, each with three levels of difficulty: easy, moderate, and difficult, with four choices of answers. You are required to answer all questions. At the end of the assessment, you will know your cognitive ability level, whether it is low, medium, or high.</span>`;
            titleDiv.innerHTML = `Welcome to CXS Cognitive Ability Assessment`;
            loginBtn.value = `Login`;
            email.placeholder = `Email`;
            password.placeholder = `Password`;
            languageLabel.innerHTML = `Select language for assessment`;
            signupLabel.innerHTML = `Don't have an account? <a href="https://talent.mynext.my/" target="_blank" id="signupBtn">Sign up</a>`;
            collabrationLabel.innerHTML = `In collaboration with`;
            copyrightDiv.innerHTML = `COPYRIGHT © <span id="thisYear">2023</span> CXS Analytics, All rights Reserved`;
        }
    });

</script>


</body>
</html>




