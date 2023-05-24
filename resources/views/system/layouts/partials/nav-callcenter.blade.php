<link rel="stylesheet" href="{{asset('css/custom.css')}}">

<div class="container">
    <form class="callcenter mb-0" id="submitForm">
        @csrf
        <input type="text" maxlength="10" id="mobilenumber" placeholder="eg. 9869286303" name="mobile_number"
               class="callcenter-input"
               onkeyup="buttonUp();"
               required>
        <input type="hidden" name="requestFrom" value="contact">
        <button type="submit" class="callcenter-submit"><em class="fa fa-arrow-alt-circle-right"
                                                            aria-hidden="true"></em></button>
        <span class="callcenter-icon"><em class="fa fa-phone" aria-hidden="true"></em></span>
    </form>
</div>


<script>
    $(document).ready(function () {
        $(".callcenter-input").on("keypress", function (event) {
            if (event.which < 48 || event.which > 57) {
                event.preventDefault();
            }
        });

        var submitIcon = $('.callcenter-icon');
        var inputBox = $('.callcenter-input');
        var callcenter = $('.callcenter');
        var isOpen = false;
        submitIcon.click(function () {
            if (isOpen == false) {
                callcenter.addClass('callcenter-open');
                var inputVal = $('.callcenter-input').val();
                inputVal = $.trim(inputVal).length;
                if (inputVal !== 0) {
                    $('.callcenter-icon').css('display', 'none');
                }
                inputBox.focus();
                isOpen = true;
            } else {
                callcenter.removeClass('callcenter-open');
                inputBox.focusout();
                isOpen = false;
            }
        });
        submitIcon.mouseup(function () {
            return false;
        });
        callcenter.mouseup(function () {
            return false;
        });
        $(document).mouseup(function () {
            if (isOpen == true) {
                $('.callcenter-icon').css('display', 'block');
                $('.callcenter-icon').css('padding', '3px');
                submitIcon.click();
            }
        });
    });

    function buttonUp() {
        var inputVal = $('.callcenter-input').val();
        inputVal = $.trim(inputVal).length;
        if (inputVal !== 0) {
            $('.callcenter-icon').css('display', 'none');
        } else {
            $('.callcenter-input').val('');
            $('.callcenter-icon').css('display', 'block');
            $('.callcenter-icon').css('padding', '3px');
        }
    }

    $("#submitForm input").keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            callcenterContactPost();
        }
    });

    $('#submitForm').on('submit', function (e) {
        e.preventDefault();
        callcenterContactPost();
    })

    function callcenterContactPost() {
        var mobileNumber = $('#mobilenumber').val();
        if (mobileNumber.length < 10) {
            toastr.error("Please Insert At Least 10 Numbers");
            //$('#mobilenumber').val('');
            document.getElementById('mobile_number').focus();
            return false
        }
        if (!(mobileNumber.charAt(0) == "9")) {
            toastr.error("Mobile No. should start with 9");
            $('#mobilenumber').val('');
            document.getElementById('mobile_number').focus();
            return false
        }
        $.ajax({
            type: 'post',
            url: "{{ route('callCenter.contact.post') }}",
            data: {
                '_token': '{{ @csrf_token() }}',
                'mobile_number': mobileNumber,
                'source': 'ajax'
            },
            dataType: 'json',
            success: function (data) {
                window.location.href = data;
            },
        })
    }
</script>
