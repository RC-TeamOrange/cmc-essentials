@extends('layouts.master')
@section('header')
    <a href="{{ url('/teaching-units') }}">Back to teaching units</a>
    <h2>
    </h2>
    
@stop
    @section('content')
    <div class="study-material">
        @include('studyMaterials')
    </div>
    
    <script>
        /*
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
            jQuery(document).on('click', '.pagination a', function (e) {
                getStudyMaterial(jQuery(this).attr('href').split('page=')[1]);
                e.preventDefault();
            });
        });
        function getStudyMaterial(page) {
            jQuery.ajax({
                url : '?page=' + page,
                dataType: 'json',
            }).done(function (data) {
                jQuery('.study-materials').html(data);
                location.hash = page;
            }).fail(function () {
                alert('Study material could not be loaded.');
            });
        }
        */
     </script>
@stop