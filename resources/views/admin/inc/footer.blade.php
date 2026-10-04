@include('admin.page.modal-box')
<!-- footer -->
<div class="container-fluid">
    <div class="footer">
        <p>Copyright © 2018 Designed by <a href="mailto:technicalaman@examinfo.blog">TechnicalAman</a>
            All rights reserved.
        </p>
    </div>
</div>
</div>
<!-- end dashboard inner -->
</div>
</div>
</div>
<!-- jQuery -->
<script src="{{ asset('backend/js/sweetalert2@11.js') }}"></script>
@include('admin.page.sweetalert')
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/dataTables.js') }}"></script>
<script>
    let table1 = new DataTable('#dataTables1');
    let table2 = new DataTable('#dataTables2');
    let table3 = new DataTable('#dataTables3');
    let table4 = new DataTable('#dataTables4');
    let table5 = new DataTable('#dataTables5');
    let table6 = new DataTable('#dataTables6');
    let table = new DataTable("#dataTables");
</script>
<script src="{{ asset('backend/tiny/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#description',
        height: 300,
        plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen',
            'insertdatetime',
            'media', 'table', 'emoticons', 'template', 'help'
        ],
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
            'forecolor backcolor emoticons | help',
        menu: {
            favs: {
                title: 'My Favorites',
                items: 'code visualaid | searchreplace | emoticons'
            }
        },
        menubar: 'favs file edit view insert format tools table help',
        content_css: 'css/content.css',
        promotion: false

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#postImgShow').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#postImgShow").hide();
    $("#postImage").change(function() {
        readURL(this);
        $("#postImgShow").show();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#uploadImg').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#uploadImg").hide();
    $("#fileUpload").change(function() {
        readURL(this);
        $("#uploadImg").show();
    });
</script>
<script src="{{ asset('backend/js/popper.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<!-- wow animation -->
<script src="{{ asset('backend/js/animate.js') }}"></script>
<!-- select country -->
<script src="{{ asset('backend/js/bootstrap-select.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('backend/js/owl.carousel.js') }}"></script>
<!-- chart js -->
<script src="{{ asset('backend/js/Chart.min.js') }}"></script>
<script src="{{ asset('backend/js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('backend/js/utils.js') }}"></script>
<script src="{{ asset('backend/js/analyser.js') }}"></script>
<!-- nice scrollbar -->
<script src="{{ asset('backend/js/perfect-scrollbar.min.js') }}"></script>
<script>
    var ps = new PerfectScrollbar('#sidebar');
</script>
<!-- custom js -->
<script src="{{ asset('backend/js/custom.js') }}"></script>
<script src="{{ asset('backend/js/chart_custom_style1.js') }}"></script>
@stack('scripts')
</body>

</html>
