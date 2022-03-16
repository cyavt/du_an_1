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
    $(document).ready(function() {
        var id = 48
        $.ajax({
            url: "data/getMaps",
            dataType: 'json',
            success: function(data) {
                    console.log(data)
            },
            error: function() {
                console.log('lỗi')
            }
        });
    });



    var map;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: new google.maps.LatLng(-33.91722, 151.23064),
            mapTypeId: 'roadmap'
        });

        // defines custom icons
        var icons = {
            parking: {
                icon: 'https://www.calibrepress.com/wp-content/themes/calibre/images/icon_facebook.png'
            },
            library: {
                icon: 'https://maps.google.com/mapfiles/kml/shapes/library_maps.png'
            },
            info: {
                icon: 'https://www.worldremit.com/images/mish/icon-apple.svg'
            }
        };

        function addMarker(feature) {
            var marker = new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                map: map
            });
        }

        // I wrote this - don't know if it works...
        function addInfoWindow(feature) {
            // this part is from https://developers.google.com/maps/documentation/javascript/infowindows
            var infowindow = new google.maps.InfoWindow({
                content: features.content
            });
        }

        // defines locations
        var features = [{
            position: new google.maps.LatLng(-33.91721, 151.22630),
            type: 'library',
            content: 'Info 1',
        }, {
            position: new google.maps.LatLng(-33.91539, 151.22820),
            type: 'info',
            content: 'Info 2'
        }, {
            position: new google.maps.LatLng(-33.91747, 151.22912),
            type: 'library',
            content: 'Info 3'
        }, {
            position: new google.maps.LatLng(-33.91910, 151.22907),
            type: 'info',
            content: 'Info 3'
        }, {
            position: new google.maps.LatLng(-33.91725, 151.23011),
            type: 'info',
            content: 'Info 4'
        }, {
            position: new google.maps.LatLng(-33.91872, 151.23089),
            type: 'info',
            content: 'Info 5'
        }, {
            position: new google.maps.LatLng(-33.91784, 151.23094),
            type: 'info',
            content: 'Info 6'
        }, {
            position: new google.maps.LatLng(-33.91682, 151.23149),
            type: 'info',
            content: 'Info 7'
        }, {
            position: new google.maps.LatLng(-33.91790, 151.23463),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91666, 151.23468),
            type: 'info',
            content: 'Info 8'
        }, {
            position: new google.maps.LatLng(-33.916988, 151.233640),
            type: 'info',
            content: 'Info 9'
        }, {
            position: new google.maps.LatLng(-33.91662347903106, 151.22879464019775),
            type: 'parking',
            content: 'Pkng 1'
        }, {
            position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
            type: 'parking',
            content: 'Pkng 2'
        }, {
            position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
            type: 'parking',
            content: 'Pkng 3'
        }, {
            position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
            type: 'parking',
            content: 'Pkng 4'
        }, {
            position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
            type: 'parking',
            content: 'Pkng 5'
        }, {
            position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
            type: 'parking',
            content: 'Pkng 6'
        }, {
            position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
            type: 'parking',
            content: 'Pkng 7'
        }, {
            position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
            type: 'library',
            content: 'La Biblioteca'
        }];

        // adds markers via the features table
        for (var i = 0, feature; feature = features[i]; i++) {
            addMarker(feature);
            addInfoWindow(feature);
        }
    }
</script>


<!-- Data -->
<script>
    <?php if (isset($_SESSION['username'])) : ?>
        $('#button_search').on('click', function() {
            $('#result_search').html('Không tìm thấy dữ liệu')
        })
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

        // Upgrade button class name
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function() {
            $('table').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [{
                        extend: 'excel',
                        title: 'ExampleFile'
                    },
                    {
                        extend: 'pdf',
                        title: 'ExampleFile'
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