<?php
if (isset($session)) {
    require './pages/modal.php';
}
?>
<div class="load" style="display:none;">
    <img src="../assets/css/patterns/loader.gif">
</div>
<script src="../assets/js/jquery-2.1.1.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/plugins/dataTables/datatables.min.js"></script>
<script src="../assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Peity -->
<script src="../assets/js/jquery.peity.min.js"></script>

<script src="../assets/js/inspinia.js"></script>
<script src="../assets/js/plugins/pace/pace.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.min.js"></script>

<!-- Peity demo data -->
<script src="../assets/js/peity-demo.js"></script>
<!-- API MAPS -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBH6z9pLP8iIZWzfXFBV_XUjrAY27Vo2XM&callback=initMap"></script>
<script>
    var map;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: new google.maps.LatLng(16.0765639, 108.2143147),
            mapTypeId: 'roadmap'
        });

        var icons = {
            status0: {
                icon: '../assets/css/patterns/0.png'
            },
            status50: {
                icon: '../assets/css/patterns/50.png'
            },
            status100: {
                icon: '../assets/css/patterns/100.png'
            }
        };

        $.ajax({
            url: "data/getMaps",
            dataType: "json",
            success: function(data) {
                function addMarker(feature) {
                    var marker = new google.maps.Marker({
                        position: feature.position,
                        icon: icons[feature.type].icon,
                        map: map
                    });
                }

                function addInfoWindow(feature) {
                    var infowindow = new google.maps.InfoWindow({
                        content: features.content
                    });
                }

                var features = data.map((result, number, arr) => {
                    let str = result['location']
                    let substrings = str.split(", ")
                    if (result['garbagepercent'] <= 30) {
                        var status = 'status0'
                    } else if (result['garbagepercent'] <= 80) {
                        var status = 'status50'
                    } else {
                        var status = 'status100'
                    }

                    return {
                        position: {
                            lat: parseFloat(substrings[0]),
                            lng: parseFloat(substrings[1])
                        },
                        type: status,
                        content: 'Lưu trữ ' + result['garbagepercent'] + ' %',
                    }
                })
                //console.log(features)
                for (var i = 0, feature; feature = features[i]; i++) {
                    addMarker(feature);
                    addInfoWindow(feature);
                }
            },
            error: function() {
                console.log('lỗi')
            }
        });
    }
</script>


<!-- Data -->
<script>
    <?php if (isset($_SESSION['username'])) : ?>
        /* Input tên nhân viên khi bắt đầu loading*/
        /* $(window).on('load', function(event) {
            var userName = $('#userName').attr('value')
            $('#Name').html(userName)
        }) */
        /* Input dữ liệu id user */
        function add(id) {
            $('#iput').val(id);
        }
        /* BACK */
        $("#btn1").on('click', (function(e) {
            $("#content1").show()
            $("#content2").hide()
        }));

        /* Thay đổi thông tin nhân viên */
        $("#change").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "data/change",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#lgbtn').text('Đang xử lý...').prop('disabled', true)
                },
                success: function(data) {
                    //console.log(data)
                    $('#lgbtn').text('Thay đổi').prop('disabled', false)
                    if (data == true)
                        swal("Thành công !", "Thay đổi đã được thực hiện", "success").then(function() {
                            location.reload();
                        })
                    else if (data == false)
                        swal("Lỗi !", "Vui lòng thử lại !", "error")
                    else
                        swal("Lỗi !", "Lỗi không xác định !", "error")
                },
                error: function() {
                    swal("Đã xảy ra lỗi!", "Đã xảy ra lỗi cục bộ, vui lòng thử lại!", "error")
                    $('#lgbtn').text('Đăng nhập').prop('disabled', false)
                }
            });
        }));

        /* THÊM USER */
        $("#Add").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "data/adduser",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#lgbtn').text('Đang xử lý...').prop('disabled', true).ready(function() {
                        $("#add").modal('hide');
                    });
                },
                success: function(data) {
                    //console.log(data)
                    $('#lgbtn').text('Thực hiện').prop('disabled', false)
                    if (data == true)
                        swal("Thành công !", "Thêm thành công", "success").then(function() {
                            location.reload();
                        })
                    else if (data == 'null')
                        swal("Lỗi !", "Vui lòng điền đủ thông tin!", "error")
                    else
                        swal("Lỗi !", "Vui lòng thử lại !", "error")
                },
                error: function() {
                    swal("Đã xảy ra lỗi!", "Đã xảy ra lỗi cục bộ, vui lòng thử lại!", "error")
                    $('#lgbtn').text('Thực hiện').prop('disabled', false)
                }
            });
        }));

        /* CHỈNH SỬA USER */
        $("#Edit").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "data/edit",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#lgbtn').text('Đang xử lý...').prop('disabled', true).ready(function() {
                        $("#edit").modal('hide');
                    });
                },
                success: function(data) {
                    //console.log(data)
                    $('#lgbtn').text('Thực hiện').prop('disabled', false)
                    if (data == true)
                        swal("Thành công !", "Sửa thành công", "success").then(function() {
                            location.reload();
                        })
                    else if (data == 'null')
                        swal("Lỗi !", "Vui lòng điền đủ thông tin!", "error")
                    else
                        swal("Lỗi !", "Vui lòng thử lại !", "error")
                },
                error: function() {
                    swal("Đã xảy ra lỗi!", "Đã xảy ra lỗi cục bộ, vui lòng thử lại!", "error")
                    $('#lgbtn').text('Thực hiện').prop('disabled', false)
                }
            });
        }));

        /* THÊM THÙNG RÁC MỚI */
        $("#Addtrash").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "data/addtrash",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#lgbtn').text('Đang xử lý...').prop('disabled', true)
                },
                success: function(data) {
                    $('#lgbtn').text('Thêm').prop('disabled', false)
                    if (data == true)
                        swal("Thành công !", "Thêm thành công", "success").then(function() {
                            location.reload();
                        })
                    else if (data == 'null')
                        swal("Lỗi !", "Vui lòng điền đủ thông tin!", "error")
                    else
                        swal("Lỗi !", "Mã token đã tồn tại !", "error")
                },
                error: function() {
                    swal("Đã xảy ra lỗi!", "Đã xảy ra lỗi cục bộ, vui lòng thử lại!", "error")
                    $('#lgbtn').text('Đăng nhập').prop('disabled', false)
                }
            });
        }));

        /* XÓA THÙNG RÁC */
        function xoatrash(id) {
            swal({
                title: 'Bạn chắc chắn điều này?',
                //text: alert,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Chấp nhận',
                cancelButtonText: 'Hủy'
            }).then(function() {
                $.ajax({
                    url: "data/xoatrash",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        //console.log(data)
                        if (data == true)
                            swal("Thành công", "Đã xóa !", "success").then(function() {
                                location.reload();
                            })
                        else
                            swal("Lỗi !", "Xóa không thành công !", "error")

                    },
                    error: function() {
                        swal("Đã xảy ra lỗi!", "Đã xảy ra lỗi cục bộ, vui lòng thử lại!", "error")
                    }
                });
            });
        };

        /* XEM CHI TIẾT USER */
        function xem(id) {
            $("#content1").hide()
            $("#content2").show()
            $.ajax({
                url: "data/xem",
                type: "POST",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    for (let i = 0; i < 6; i++) {
                        var a = '#vaL' + i;
                        $(a).val(data[i])
                    }
                    $('#vaL6').val(data[6] + ', ' + data[7] + ', ' + data[8] + ', ' + data[9])
                    for (let i = 0; i < 10; i++) {
                        var a = '#val' + i;
                        $(a).val(data[i])
                    }
                },
                error: function() {
                    swal("Đã xảy ra lỗi!", "Đã xảy ra lỗi cục bộ, vui lòng thử lại!", "error")
                }
            });
        };

        /* XÓA USER */
        $('#xoauser').on('click', function() {
            let id = $('#vaL0').val();
            swal({
                title: 'Bạn chắc chắn điều này?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Chấp nhận',
                cancelButtonText: 'Hủy'
            }).then(function() {
                $.ajax({
                    url: "data/xoauser",
                    type: "POST",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data == true)
                            swal("Thành công", "Đã xóa !", "success").then(function() {
                                location.reload();
                            })
                        else
                            swal("Lỗi !", "Xóa không thành công !", "error")
                    },
                    error: function() {
                        swal("Đã xảy ra lỗi!", "Đã xảy ra lỗi cục bộ, vui lòng thử lại!", "error")
                    }
                });
            });
        });


        /* Lọc Tìm kiếm */
        $(function() {
            $.getJSON("vietnam.json", function(data) {
                //console.log(data)
                $('#city').change(function() {
                    var valCity = $(this).val();
                    $('#district').empty();
                    for (i = 0; i < data[valCity]['districts'].length; i++) {
                        $('#district').append($('<option>', {
                            value: i,
                            text: data[valCity]['districts'][i]['name']
                        }));
                    };

                    $('#district').change(function() {
                        var valDistrict = $(this).val();
                        $('#ward').empty();
                        for (j = 0; j < data[valCity]['districts'][valDistrict]['wards'].length; j++) {
                            $('#ward').append($('<option>', {
                                value: j,
                                text: data[valCity]['districts'][valDistrict]['wards'][j]['name']
                            }));
                        };
                    });
                });
            });
        });

        $('#button_search').on('click', function() {
            var keyword = $('#city :selected').text();
            if (keyword == '') {
                keyword = 0
            }
            console.log(keyword)
            $.ajax({
                url: "data/search",
                type: "POST",
                data: {
                    keyword: keyword
                },
                dataType: 'json',
                success: function(data) {
                    if (data['result'] == 'no data found') {
                        $('#result_search').empty();
                        $('#result_search').append(`<h3 class="text-muted text-center">Không tìm thấy kết quả</h3>`)
                    } else {
                        $('#result_search').empty();
                        data.map(function(item) {
                            $('#result_search').append(`
            <div class="col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">Thông tin tìm kiếm</div>
                    <div class="panel-body">
                        <p>Tên: ${item['name']} </p>
                        <p>Địa chỉ: ${item['address']}, ${item['ward']}, ${item['district']}, ${item['city']} </p>
                    </div>
                </div>
            </div>`);
                        });
                    }
                },
                error: function() {
                    console.log('Lỗi')
                }
            });
        });

        // Upgrade button class name
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function() {
            $('table').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [{
                        extend: 'excel',
                        title: 'Danh sách quản lý'
                    },
                    {
                        extend: 'pdf',
                        title: 'Danh sách quản lý'
                    },

                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ],
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                "language": {
                    "search": "Tìm Kiếm",
                    "zeroRecords": "Không tìm thấy kết quả",
                    "paginate": {
                        "first": "Về Đầu",
                        "last": "Về Cuối",
                        "next": "Tiến",
                        "previous": "Lùi"
                    },
                    "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
                    "lengthMenu": "Hiển thị _MENU_ mục",
                    "infoFiltered": "(Được lọc từ _MAX_ Mục)",
                    "loadingRecords": "Đang tải...",
                    "emptyTable": "Không có gì để hiển thị"
                }

            });

        });

    <?php endif; ?>

    /* preload */
    function loading() {
        $('.load').delay(1000).show().fadeOut('slow')
    }
    /* $(window).on('load', function(event) {
        loading()
    }); */

    /* ĐĂNG NHẬP */
    $("#Login").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "data/login",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#lgbtn').text('Đang xử lý...').prop('disabled', true)
            },
            success: function(data) {
                $('#lgbtn').text('Đăng nhập').prop('disabled', false)
                if (data == true)
                    swal("Thành công !", "Đăng nhập thành công", "success").then(function() {
                        loading()
                        setTimeout(function() {
                            location.reload()
                        }, 1000)
                    })
                else if (data == false)
                    swal("Lỗi đăng nhập!", "Tài khoản hoặc mật khẩu không đúng!", "error")
                else if (data == 'null')
                    swal("Lỗi đăng nhập!", "Vui lòng điền đủ thông tin!", "error")
                else
                    swal("Lỗi đăng nhập!", "Máy chủ không phản hồi dữ liệu!", "error")
            },
            error: function() {
                swal("Đã xảy ra lỗi!", "Đã xảy ra lỗi cục bộ, vui lòng thử lại!", "error")
                $('#lgbtn').text('Đăng nhập').prop('disabled', false)
            }
        });
    }));
</script>

</body>

</html>