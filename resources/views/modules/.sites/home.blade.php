@extends('templates.layouts.gentalella')
@section('content')
<div class="about-section">
   <div class="text-content">
     <div class="span7 offset1">
        @if(Session::has('success'))
          <div class="alert-box success">
          <h2>{!! Session::get('success') !!}</h2>
          </div>
        @endif
        <div class="secure">Upload form</div>
        <!-- {!! Form::open(array('url'=>'upload/set','method'=>'POST', 'files'=>true)) !!} -->
        {!! Form::open(array('method'=>'POST', 'id'=>'frm_upload', 'files'=>true)) !!}
         <div class="control-group">
          <div class="controls">
          {!! Form::file('_file') !!}
          {!! Form::text('_test','123') !!}
          <!-- {!! Form::hidden('_token', csrf_token()  ) !!} -->
          <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
      <p class="errors">{!!$errors->first('image')!!}</p>
    @if(Session::has('error'))
    <p class="errors">{!! Session::get('error') !!}</p>
    @endif
        </div>
        </div>
        <div id="success"> </div>
      {!! Form::submit('Submit', array('class'=>'send-btn')) !!}
      <!-- {!! Form::button('Upload Ajax', array('class'=>'btn','onclick'=>'javascript:upload1();')) !!} -->
      {!! Form::close() !!}
      </div>
   </div>
</div>

<script type="text/javascript">
function upload1(){   
    // console.log($('form#frm_upload').serialize());
    $.ajax({
        type : 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        url  : 'upload',
        data : $('form#frm_upload').serialize(),
        dataType  : 'json',
        success: function(response) {
            console.log(response);    
        }
    });
}

$(document).ready(function(){

    $('form#frm_upload').on('submit', function(e){
        // var formData = new FormData(this);
        var formData = new FormData($(this)[0]);
         
        // formData.append('_token',$('meta[name="_token"]').attr('content'));
        
        // $.ajaxSetup({
            // header:$('meta[name="_token"]').attr('content')
        // });

        e.preventDefault(e);
        // console.log(formData);
        // console.log($('meta[name="_token"]').attr('content'));//.attr('content'));

        $.ajax({
            type : 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url  : 'upload',
            data : formData,
            // data : $(this).serialize(),
            processData:false,
            contentType: false,
            dataType  : 'json',
            success: function(response) {
                console.log(response);    
            },
            error: function(data){
                console.log('error broo');    
            // Error...
            }
        });
    });
})    //console.log($('form#frm_upload').serialize());


    
</script>
@stop