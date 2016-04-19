@extends('layouts.master')
@section('header')
    <a href="{{ url('/teaching-units') }}">Back to teaching units</a>
    <h2>
        <span id="hms_timer" class="pull-right" data-seconds-left="{{$timeLeft}}"></span><div class="clearfix"></div>
    </h2>
    
@stop
    @section('content')
    <div class="study-material">
        @include('studyMaterials')
    </div>
    <input type="hidden" id="teachingUnit" value="{{ $teachingUnit->id }}" />
    <script>
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*
        $(document).ready(function(){
            $(".pagination a").bind("click", function(e){
                getStudyMaterial($(this).attr('href').split('page=')[1]);
                e.preventDefault();
            });
        });
        function getStudyMaterial(page) {
            console.log('/page/' + page);
            $.ajax({
                type: "GET",
                url : '/?page=' + page,
                dataType: 'json',
                data: { teachingUnitId : $("teachingUnit").val() },
                success: function(data){
                    console.log(data);
                    jQuery('.study-materials').html(data);
                }
            });
        }
        */
        
        jQuery(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getStudyMaterial(page);
                }
            }
        });
        jQuery(document).ready(function() {
            jQuery(document).on('click', '.pagination li a', function (e) {
                getStudyMaterial(jQuery(this).attr('href').split('page=')[1]);
                e.preventDefault();
            });
        });
        function getStudyMaterial(page) {
            jQuery.ajax({
                type: "GET",
                url : '?page=' + page,
                dataType: 'json'
            }).done(function (data) {
                jQuery('.study-material').html(data.responseText);
                location.hash = page;
            }).fail(function (data) {
                jQuery('.study-material').html(data.responseText);
                location.hash = page;
            });
        }
        
     </script>
     <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery(function(){
                jQuery('#hms_timer').startTimer({
                    onComplete: function(element){
                        window.location.replace("{{ url('/teaching-units') }}");
                    }
                });
            });
        });
        </script>
@stop