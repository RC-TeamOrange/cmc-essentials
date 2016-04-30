
@foreach ($studyMaterials as $studyMaterial)
    <article>
        <div class="well">
            <h3 class="slide-progress"><span class="desc title">Reading card: </span><span class="count num current">{{ $studyMaterials->currentPage() }}</span><span class="desc separator"> of </span><span class="count num total">{{ $studyMaterials->total() }}</span></h3>
            <h2>{{ $studyMaterial->title }}</h2>
            {!! $studyMaterial->description !!}
        </div>
    </article>
@endforeach
   
<div class="pager">
{!! with(new CmcEssentials\PaginationPresenter($studyMaterials))->render($teachingUnit) !!}

</div>
