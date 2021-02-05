@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Select files</h3>
        </div>
        <div class="panel-body">
            <form id="dropzoneForm" class="dropzone" action="{{ route('dropzone.upload') }}">
                @csrf
            </form>
            <button type="button" class="btn btn-info" id="submit-all">Upload</button>

        </div>
    </div>
    <br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Uploaded File</h3>
        </div>
        <div class="panel-body" id="uploaded_image">

        </div>
    </div>
</div>
@endsection

@section('scrpit')
<script type="text/javascript">

    Dropzone.options.dropzoneForm = {
        autoProcessQueue : false,
        acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg,.txt,.pdf,.odt",

        init:function(){
            var submitButton = document.querySelector("#submit-all");
            myDropzone = this;

            submitButton.addEventListener('click', function(){
                myDropzone.processQueue();
            });

            this.on("complete", function(){
                if(this.getQueuedFiles().length === 0 && this.getUploadingFiles().length === 0) {
                    var _this = this;
                    _this.removeAllFiles();
                }
                load_images();
            });

        }

    };

    load_images();

    function load_images() {
        $.ajax({
            url:"{{ route('dropzone.fetch') }}",
            success:function(data)
            {
                $('#uploaded_image').html(data);
            }
        })
    }

    $(document).on('click', '.remove_image', function(){
        var name = $(this).attr('id');
        $.ajax({
            url:"{{ route('dropzone.delete') }}",
            data:{name : name},
            success:function(data){
                load_images();
            }
        })
    });

</script>
@endsection
