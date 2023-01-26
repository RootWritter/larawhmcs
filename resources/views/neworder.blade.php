@extends('template')
@section('view')
<div class="row">
    <div class="col-12">
        <h1>Pemesan Baru</h1>
    </div>
    <div class="col-md-12">
        <form id="order-form" method="POST">
            <input type="hidden" id="user_id" name="user_id" value="">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="mt-2 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Choose a Packages</h4>
                                    <small>Fit your requiment</small>
                                    <div class="form-group">
                                        <select class="form-select" name="packages_id" id="packages">
                                            <option value="null">Please Choose One</option>
                                            @foreach($product as $p)
                                            <option value="{{ $p['pid'] }}">{{ $p['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Choose a Billing Cycle</h4>
                                    <small>Renewal price are same</small>
                                    <div class="form-group">
                                        <select class="form-select" id="pricing" name="period">
                                            <option value="null">Please Choose One Packages</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Please Fill your domain for your hosting</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_domain" id="type_domain1" value="register_new" checked>
                                        <label class="form-check-label" for="type_domain1">
                                            Register New Domains
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_domain" id="type_domain2" value="have_domain">
                                        <label class="form-check-label" for="type_domain2">
                                            I have a domain
                                        </label>
                                    </div>
                                    <div class="register_domain">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="domain" placeholder="Get your awesome domain" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <select class="form-select" name="extension" id="domain_extension">
                                                <option>Please wait, getting domain extension....</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="have_domain" style="display: none;">
                                        <input class="form-control" name="domain_new" placeholder="input your domain">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 col-md-12" id="login_register">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Information of account</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_account" id="type_account1" value="login" checked>
                                        <label class="form-check-label" for="type_account1">
                                            I have an account
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_account" id="type_account2" value="register">
                                        <label class="form-check-label" for="type_account2">
                                            I don't have an account
                                        </label>
                                    </div>
                                    <div class="login">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" type="text" id="login_email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" type="password" id="login_password" placeholder="Password">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-warning w-100 mt-2" type="button" id="login">Login</button>
                                    </div>
                                    <div class="register" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" type="text" id="register_email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">+62</span>
                                                        <input type="text" class="form-control" placeholder="8123-82380-0823" id="register_phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input class="form-control" type="text" id="register_name" placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" type="password" id="register_password" placeholder="Password">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-warning w-100 mt-2" type="button" id="register">Register Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-dark">
                        <div class="card-body">
                            <h4 class="text-white">Ringkasan Pesanan</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="2">Detail</td>
                                        <td>1 items</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" id="product_name">Product Name</td>
                                        <td id="price"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Sub Total</td>
                                        <td id="sub_total"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">PPN @ 11.00%</td>
                                        <td id="ppn"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h3 id="total_price">Rp. 999.000</h3>
                            <button type="submit" class="btn btn-warning w-100">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    let pricing_packages;
    let price = 0;

    function formatRupiah(bilangan) {
        var number_string = bilangan.toString().replace(/[^,\d]/g, ''),
            split = number_string.split('.'),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp. ' + rupiah;
    }
    x = {
        aInternal: 10,
        aListener: function(val) {},
        set a(val) {
            this.aInternal = val;
            this.aListener(val);
        },
        get a() {
            return this.aInternal;
        },
        registerListener: function(listener) {
            this.aListener = listener;
        }
    }
    x.registerListener(function(val) {
        const persen = 11;
        const angka = persen / 100;
        const ppn = price * angka;
        $("#sub_total").html(formatRupiah(price));
        $("#ppn").html(formatRupiah(ppn));
        $("#total_price").html(formatRupiah(price + ppn));
    });
    $("input[type='radio'][name='type_account']").on('change', function() {
        var checked = $(this).filter(':checked').val();
        if (checked == "login") {
            $(".login").css('display', 'block');
            $(".register").css('display', 'none');
        } else {
            $(".login").css('display', 'none');
            $(".register").css('display', 'block');
        }
    });
    $("input[type='radio'][name='type_domain']").on('change', function() {
        var checked = $(this).filter(':checked').val();
        if (checked == "have_domain") {
            $(".have_domain").css('display', 'block');
            $(".register_domain").css('display', 'none');
        } else {
            $(".have_domain").css('display', 'none');
            $(".register_domain").css('display', 'block');
        }
    });
    getDomainPricing();
    async function getDomainPricing() {
        let domainExtension = "";
        let form = new FormData();
        form.append('_token', csrf_token);
        axios.post("{{url('ajax/get-domain')}}", form)
            .then(response => {
                domainExtension = `<option value="null">Please Select Domain Extentions</option>`;
                for (var key in response.data.pricing) {
                    domainExtension += `<option value="${key}" data-price="${response.data.pricing[key]}">.${key} ${response.data.prefix} ${response.data.pricing[key]}/Years ${response.data.suffix}</option>`;
                }
                $("#domain_extension").html(domainExtension);
            })
            .catch(error => {
                if (error.response) {
                    let errorList = '';
                    errorList += '<ul style="list-style-type: none;">';
                    $.each(error.response.data.errors, function(key, value) {
                        errorList += '<li>' + value + '</li>';
                    });
                    errorList += '</ul>';
                    setTimeout(function() {
                        swal.fire({
                            title: 'Oops...',
                            icon: 'error',
                            html: errorList,
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200);
                } else if (error.request) {
                    // The request was made but no response was received
                    // console.log(error.request);
                    setTimeout(function() {
                        swal.fire({
                            title: 'Oops...',
                            icon: 'error',
                            text: 'Something went wrong!',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
            });
    }
    $("#packages").on('change', function() {
        var val = $(this).val();
        var package_name = $(this).find(':selected').text();
        $("#product_name").html(package_name);
        let form = new FormData();
        form.append('_token', csrf_token);
        form.append('id', val);
        axios.post("{{url('ajax/get-product')}}", form)
            .then(response => {
                pricing_packages = `<option value="null">Please Select Billing Cycle</option>`;
                for (var key in response.data.pricing) {
                    pricing_packages += `<option value="${key}" data-price="${response.data.pricing[key]}">${response.data.prefix} ${response.data.pricing[key]} ${response.data.suffix}</option>`;
                }
                $("#pricing").html(pricing_packages);
            })
            .catch(error => {
                if (error.response) {
                    let errorList = '';
                    errorList += '<ul style="list-style-type: none;">';
                    $.each(error.response.data.errors, function(key, value) {
                        errorList += '<li>' + value + '</li>';
                    });
                    errorList += '</ul>';
                    setTimeout(function() {
                        swal.fire({
                            title: 'Oops...',
                            icon: 'error',
                            html: errorList,
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200);
                } else if (error.request) {
                    // The request was made but no response was received
                    // console.log(error.request);
                    setTimeout(function() {
                        swal.fire({
                            title: 'Oops...',
                            icon: 'error',
                            text: 'Something went wrong!',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
            });
    })
    $("#pricing").on('change', function() {
        var value = $(this).val();
        if (value !== "null") {
            let data = parseInt($(this).find(':selected').data('price'));
            var harga = $(this).find(':selected').text();
            price = price + data;
            x.a = harga;
            $("#price").html(harga)
        }
    })
    $("#domain_extension").on('change', function() {
        var value = $(this).val();
        if (value !== "null") {
            let data = parseInt($(this).find(':selected').data('price'));
            var harga = $(this).find(':selected').text();
            price = price + data;
            x.a = harga;
        }
    })
    $("#login").on('click', function(e) {
        e.preventDefault();
        let form = new FormData();
        form.append('_token', csrf_token);
        form.append('email', $("#login_email").val());
        form.append('password', $("#login_password").val());
        axios.post("{{url('ajax/sign-in')}}", form)
            .then(response => {
                if (response.data.status) {
                    $("#login_register").remove();
                    swal.fire({
                        title: 'Success',
                        icon: 'success',
                        text: response.data.message,
                        buttonsStyling: false,
                        confirmButtonText: 'Ok',
                        customClass: {
                            confirmButton: 'btn font-weight-bold btn-primary',
                        },
                    });
                    $("#user_id").val(response.data.data.id);
                } else {
                    swal.fire({
                        title: 'Oops...',
                        icon: 'error',
                        text: response.data.message,
                        buttonsStyling: false,
                        confirmButtonText: 'Ok lets check',
                        customClass: {
                            confirmButton: 'btn font-weight-bold btn-danger',
                        },
                    });
                }

            })
            .catch(error => {
                if (error.response) {
                    let errorList = '';
                    errorList += '<ul style="list-style-type: none;">';
                    $.each(error.response.data.errors, function(key, value) {
                        errorList += '<li>' + value + '</li>';
                    });
                    errorList += '</ul>';
                    setTimeout(function() {
                        swal.fire({
                            title: 'Oops...',
                            icon: 'error',
                            html: errorList,
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200);
                } else if (error.request) {
                    // The request was made but no response was received
                    // console.log(error.request);
                    setTimeout(function() {
                        swal.fire({
                            title: 'Oops...',
                            icon: 'error',
                            text: 'Something went wrong!',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
            });
    })
    $("#register").on('click', function(e) {
        e.preventDefault();
        let form = new FormData();
        form.append('_token', csrf_token);
        form.append('email', $("#register_email").val());
        form.append('password', $("#register_password").val());
        form.append('phone', $("#register_phone").val());
        form.append('name', $("#register_name").val());
        axios.post("{{url('ajax/sign-up')}}", form)
            .then(response => {
                if (response.data.status) {
                    $("#login_register").remove();
                    swal.fire({
                        title: 'Success',
                        icon: 'success',
                        text: response.data.message,
                        buttonsStyling: false,
                        confirmButtonText: 'Ok',
                        customClass: {
                            confirmButton: 'btn font-weight-bold btn-primary',
                        },
                    });
                    $("#user_id").val(response.data.data.id);
                } else {
                    swal.fire({
                        title: 'Oops...',
                        icon: 'error',
                        text: response.data.message,
                        buttonsStyling: false,
                        confirmButtonText: 'Ok lets check',
                        customClass: {
                            confirmButton: 'btn font-weight-bold btn-danger',
                        },
                    });
                }

            })
            .catch(error => {
                if (error.response) {
                    let errorList = '';
                    errorList += '<ul style="list-style-type: none;">';
                    $.each(error.response.data.errors, function(key, value) {
                        errorList += '<li>' + value + '</li>';
                    });
                    errorList += '</ul>';
                    setTimeout(function() {
                        swal.fire({
                            title: 'Oops...',
                            icon: 'error',
                            html: errorList,
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200);
                } else if (error.request) {
                    // The request was made but no response was received
                    // console.log(error.request);
                    setTimeout(function() {
                        swal.fire({
                            title: 'Oops...',
                            icon: 'error',
                            text: 'Something went wrong!',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
            });
    })
    $("#order-form").submit(function(e) {
        e.preventDefault();
        let form = new FormData(this);
        form.append("_token", csrf_token);
        axios.post("{{url('ajax/do-order')}}", form)
            .then(response => {
                if (response.data.status) {
                    let urlInvoice = response.data.data.url_invoice;
                    Swal.fire({
                        title: 'Success',
                        icon: 'success',
                        text: response.data.message,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Go to invoice page'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = urlInvoice;
                        }
                    })
                } else {
                    swal.fire({
                        title: 'Oops...',
                        icon: 'error',
                        text: response.data.message,
                        buttonsStyling: false,
                        confirmButtonText: 'Ok lets check',
                        customClass: {
                            confirmButton: 'btn font-weight-bold btn-danger',
                        },
                    });
                }
            })
            .catch(error => {
                if (error.response) {
                    let errorList = '';
                    errorList += '<ul style="list-style-type: none;">';
                    $.each(error.response.data.errors, function(key, value) {
                        errorList += '<li>' + value + '</li>';
                    });
                    errorList += '</ul>';
                    setTimeout(function() {
                        swal.fire({
                            title: 'Oops...',
                            icon: 'error',
                            html: errorList,
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200);
                } else if (error.request) {
                    // The request was made but no response was received
                    // console.log(error.request);
                    setTimeout(function() {
                        swal.fire({
                            title: 'Oops...',
                            icon: 'error',
                            text: 'Something went wrong!',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
            });
    })
</script>
@endsection