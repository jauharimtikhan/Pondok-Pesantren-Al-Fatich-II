<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Al Fatih Admin Panel</title>
    {{-- <link rel="shortcut icon" href="{{ asset('assets') }}/compiled/svg/favicon.svg" type="image/x-icon"> --}}
    <link rel="shortcut icon" href="{{ asset('assets-landing-page/img/favicon.ico') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets') }}/extensions/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/compiled/css/app.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/compiled/css/app-dark.css">
    <link href="{{ asset('assets') }}/extensions/sweetalert2/sweetalert2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets') }}/extensions/filepond/filepond.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/r-3.0.0/sl-2.0.0/datatables.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/extensions/choices.js/public/assets/styles/choices.css">
    <style>
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .input-group-text i {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    @stack('css')
    <script src="{{ asset('assets') }}/extensions/jquery/jquery.min.js"></script>
</head>

<body>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                @include('admin::layouts\navbar')
                @include('admin::layouts\sidebar')
            </div>
        </div>
        <div id="main" class='layout-navbar navbar-fixed'>
            @yield('content')
            @include('admin::layouts\footer')
        </div>
    </div>

    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/r-3.0.0/sl-2.0.0/datatables.min.js">
    </script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/static/js/components/dark.js"></script>
    <script src="{{ asset('assets') }}/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets') }}/static/js/initTheme.js"></script>
    <script src="{{ asset('assets') }}/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('assets') }}/extensions/sweetalert2/sweetalert2.all.min.js"></script>
    <script
        src="{{ asset('assets') }}/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js">
    </script>
    <script
        src="{{ asset('assets') }}/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script
        src="{{ asset('assets') }}/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js">
    </script>
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js">
    </script>
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js">
    </script>
    <script src="{{ asset('assets') }}/extensions/filepond/filepond.js"></script>
    <script src="{{ asset('assets') }}/static/js/pages/filepond.js"></script>
    <script src="https://cdn.tiny.cloud/1/jms2tweywgkzz1rnsadif6d4hoxe24xqkvmrqstu4e9ov9ff/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('assets') }}/extensions/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('assets') }}/static/js/pages/date-picker.js"></script>
    <script src="{{ asset('assets') }}/extensions/jquery-maskmoney/dist/jquery.maskMoney.min.js"></script>
    <script src="{{ asset('assets') }}/extensions/jquery-maskmoney/dist/jquery.maskMoney.js"></script>
    <script id="appjs" src="{{ asset('assets') }}/compiled/js/app.js"></script>

    <script>
        let choices = document.querySelectorAll(".choices");
        let initChoice;
        for (let i = 0; i < choices.length; i++) {
            if (choices[i].classList.contains("multiple-remove")) {
                initChoice = new Choices(choices[i], {
                    delimiter: ",",
                    editItems: true,
                    maxItemCount: -1,
                    removeItemButton: true,
                    allowHTML: true,
                });
            } else {
                initChoice = new Choices(choices[i], {
                    delimiter: ",",
                    editItems: true,
                    maxItemCount: -1,
                    removeItemButton: true,
                    allowHTML: true,
                });
            }
        }

        function Toast(msg, icon) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            return Toast.fire({
                icon: icon,
                title: msg
            });
        }

        function DeleteData(datas) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success mx-2",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            return swalWithBootstrapButtons.fire({
                title: datas.title,
                text: datas.text,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: datas.confirmButtonText,
                cancelButtonText: datas.cancelButtonText,
                reverseButtons: true
            })
        }

        function ConvertRP(angka) {
            let reverse = angka.toString().split("").reverse().join("");
            let ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join(".").split("").reverse().join("");
            return "Rp " + ribuan;
        }

        function formatRupiah(number) {
            let result = "";

            if (number >= 1000000000) {
                const billion = Math.floor(number / 1000000000);
                const million = Math.round((number % 1000000000) / 1000000);
                if (million === 0) {
                    result = `${billion} M`;
                } else {
                    result = `${billion}.${million} M`;
                }
            } else if (number >= 1000000) {
                const million = Math.floor(number / 1000000);
                const thousand = Math.round((number % 1000000) / 1000);
                if (thousand === 0) {
                    result = `${million} JT`;
                } else {
                    result = `${million}.${thousand} JT`;
                }
            } else if (number >= 1000) {
                const thousand = Math.floor(number / 1000);
                result = `${thousand} K`;
            } else {
                result = `${number}`;
            }

            return result;
        }

        function cleanMaskMoney(number) {
            return number.maskMoney('unmasked')[0]
        }
    </script>
    @stack('js')

</body>

</html>
