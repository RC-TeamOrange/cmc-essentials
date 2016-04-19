@extends('layouts.master')
@section('header')
    <a href="{{ route('teaching-units::study', ['slug'=>$teachingUnit->slug]) }}">Back to study content</a>
    <h2>
        {{ $teachingUnit->title}} Quiz <span id="hms_timer" class="pull-right" data-seconds-left="{{$timeLeft}}"></span><div class="clearfix"></div>
    </h2>
    
@stop
    @section('content')
    <div class="quiz-question">
        @include('quiz.quizQuestion')
    </div>
    
    <script>
        
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
            jQuery("input").each(function(){
                jQuery(this).change(function(){
                    if(jQuery(this).is(':checked')){
                        var choice = jQuery(this).attr('id'); 
                        saveChoice(choice);  
                    }
                });
            });
        });
        function saveChoice(choice){
            jQuery.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            jQuery.ajax({
                type: "POST",
                dataType: 'json',
                data:{choice: choice, question: jQuery("#questionId").val()}
            }).done(function (data) {
                console.log(data);
            }).fail(function (data) {
                jQuery('.quiz-question').html(data.responseText);
            });
        }
        function getStudyMaterial(page) {
            jQuery.ajax({
                type: "GET",
                url : '?page=' + page,
                dataType: 'json'
            }).done(function (data) {
                jQuery('.quiz-question').html(data.responseText);
                location.hash = page;
            }).fail(function (data) {
                jQuery('.quiz-question').html(data.responseText);
                location.hash = page;
                jQuery("input").each(function(){
                    jQuery(this).change(function(){
                        if(jQuery(this).is(':checked')){
                            var choice = jQuery(this).attr('id'); 
                            saveChoice(choice);  
                        }
                    });
                });
            });
        }
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