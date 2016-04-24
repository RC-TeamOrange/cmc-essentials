
@foreach ($studyMaterials as $studyMaterial)
    <article>
        <h2>{{ $studyMaterial->title }}</h2>
        <div class="text-justify"> {!! $studyMaterial->description !!} </div>
    </article>
@endforeach
   
<div class="pager">
{!! with(new CmcEssentials\PaginationPresenter($studyMaterials))->render($teachingUnit) !!}
</div>
