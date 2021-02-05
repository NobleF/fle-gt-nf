@extends('layouts.app')

@section('content')
<div class="container lst">


    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <h3 class="well">Laravel 6 Multiple File Upload</h3>
    <form method="post" action="{{url('file.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <div id="fileList">
            <div class="input-group hdtuto control-group lst increment" >
                <input type="file" name="filenames[]" class="myfrm form-control">
            </div>
        </div>

        <button type="button" class="btn btn-info" style="margin-top:10px" onclick="addFile()"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
        <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>


    </form>
</div>

@endsection

@section('scrpit')
<script type="text/javascript">

    let val = 0;

    function addFile() {
        console.log("ok");
        $("#fileList").append('' +
            '<div class="input-group hdtuto control-group lst increment" id="file-n'+ val +'">' +
                '<div class="hdtuto control-group lst input-group" style="margin-top:10px">' +
                    '<input type="file" name="filenames[]" class="myfrm form-control">' +
                    '<div class="input-group-btn">' +
                        '<button class="btn btn-danger" type="button" onclick="removeFile('+val+')"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>' +
                    '</div>' +
                '</div>' +
            '</div>'
        );
        val++;
    }

    function removeFile(nb) {
        $("#file-n"+nb).remove();
        console.log(nb);
    }

    //$(document).ready(function() {
    //    $(".btn-success").click(function(){
    //        var lsthmtl = $(".clone").html();
    //        $(".increment").after(lsthmtl);
    //    });
    //    $("body").on("click",".btn-danger",function(){
    //        $(this).parents(".hdtuto control-group lst").remove();
    //    });
    //});
</script>
@endsection
