<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets')}}/home/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{asset('assets')}}/home/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Product Page - Material Kit PRO by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

    <!-- CSS Files -->
    <link href="{{asset('assets')}}/home/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="{{asset('assets')}}/home/css/material-kit.css?v=1.2.1" rel="stylesheet"/>
</head>

<body class="product-page">
@include('home.navbar')

@include('home.header')

<div class="section section-gray">
    <div class="container">
        <div class="main main-raised main-product">
            <div class="row">
                <div class="col-md-6 col-sm-6">

                    <div class="tab-content" id="product_image">
                    </div>
                    <ul class="nav flexi-nav" role="tablist" id="flexiselDemo1">
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h2 class="title" id="product_name"></h2>
                    <h3 class="main-price" id="product_price"></h3>
                    <div id="acordeon">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-border panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                       aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="panel-title">
                                            Mô tả
                                            <i class="material-icons">keyboard_arrow_down</i>
                                        </h4>
                                    </a>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <p id="product_des"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-border panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                       aria-controls="collapseOne">
                                        <h4 class="panel-title">
                                            Thông số chi tiết
                                            <i class="material-icons">keyboard_arrow_down</i>
                                        </h4>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body" id="detail">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!--  end acordeon -->

                    <div class="row pick-size">
                        <div class="col-md-6 col-sm-6">
                        </div>
                        <div class="col-md-6 col-sm-6">
                        </div>
                    </div>
                    <div class="row text-right">
                        <a href="{{route('cart.add',[$id])}}" class="btn btn-success btn-round">Thêm vào giỏ hàng &nbsp;<i class="material-icons">shopping_cart</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="features text-center">
            <div class="row">
                <div class="col-md-6">
                    <div class="info">
                        <div class="icon icon-info">
                            <i class="material-icons">local_shipping</i>
                        </div>
                        <h4 class="info-title">Giao hàng trong 2 ngày khu vực nội thành</h4>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info">
                        <div class="icon icon-success">
                            <i class="material-icons">verified_user</i>
                        </div>
                        <h4 class="info-title">Hỗ trợ đổi sản phẩm khác trong vòng 7 ngày nếu có lỗi từ nhà sản
                            xuất</h4>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@include('home.footer')
<script>
    $(document).ready(function () {
        $.ajax({
            url: '{{ route('api.product.one',[$id]) }}',
            dataType: 'json',
            success: function (response) {
                let _des= response.data.use +': '+response.data.cpu+'/'+response.data.ram+'/'+response.data.ssd;
                $('#detail').append(response.data.detail);
                $('#product_name').append(response.data.name);
                $('#product_des').html(_des);
                $('#product_price').append(getPrice(response.data.price));
            },
            error: function (response) {
            }
        })

        $.ajax({
            url: '{{ route('api.image.full',[$id]) }}',
            dataType: 'json',
            success: function (response) {
                let count = 1;
                let _html = '';
                let _html2 = '';
                response.data.forEach(function (each) {
                    let image = '<img src="' + '/storage/' + each.image + '">'
                    if (count == 1) {
                        _html = '<div class="tab-pane active" id="product-page' + count + '">' +
                            image +
                            '</div>';
                        _html2 = '<li class="active">' +
                            '<a href="#product-page' + count + '" role="tab" data-toggle="tab" aria-expanded="false">' +
                            image +
                            '</a></li>'
                    } else {
                        _html = '<div class="tab-pane" id="product-page' + count + '">' +
                            image +
                            '</div>';
                        _html2 = '<li>' +
                            '<a href="#product-page' + count + '" role="tab" data-toggle="tab" aria-expanded="false">' +
                            image +
                            '</a></li>'
                    }
                    $('#product_image').append(_html);
                    $('#flexiselDemo1').append(_html2);
                    count++;
                });

                $("#flexiselDemo1").flexisel({
                    visibleItems: 3,
                    itemsToScroll: 1,
                    animationSpeed: 400,
                    enableResponsiveBreakpoints: true,
                    responsiveBreakpoints: {
                        portrait: {
                            changePoint: 480,
                            visibleItems: 3
                        },
                        landscape: {
                            changePoint: 640,
                            visibleItems: 3
                        },
                        tablet: {
                            changePoint: 768,
                            visibleItems: 3
                        }
                    }
                });
            },
            error: function (response) {
            }
        })


    });
</script>

<script src="{{asset('assets')}}/home/js/jquery.flexisel.js"></script>
</body>
</html>