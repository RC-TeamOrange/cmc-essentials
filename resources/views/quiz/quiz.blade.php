@extends('layouts.master')
@section('header')
    <a href="{{ route('teaching-units::study', ['slug'=>$teachingUnit->slug]) }}" style="color: #547477"><span class="glyphicon glyphicon-arrow-left"></span>&nbspBack to study content</a>
    <h2>
        {{ $teachingUnit->title}} Quiz <span class="pull-right" >Time left: <span id="hms_timer" data-seconds-left="{{$timeLeft}}"></span></span><div class="clearfix"></div>
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
                    getQuestion(page);
                }
            }
        });
        jQuery(document).ready(function() {
            jQuery(document).on('click', '.pagination li a', function (e) {
                getQuestion(jQuery(this).attr('href').split('page=')[1]);
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
         jQuery.ajaxSetup({
                 headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
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
                data:{action: "saveChoice", choice: choice, question: jQuery("#questionId").val()}
            }).done(function (data) {
            }).fail(function (data) {
                jQuery('.quiz-question').html(data.responseText);
            });
        }
        function updateTimer(timeLeft){
             jQuery.ajax({
                 type: "POST",
                 dataType: 'json',
                 data:{action: "updateTimer", timeLeft: timeLeft}
             }).done(function (data) {
             }).fail(function (data) {
             });
         }
 
        function getQuestion(page) {
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
                    },
                    onTimeLeft: function(timeLeft){
                        updateTimer(timeLeft);
                    }
                });
            });
        });
     </script>
@stop