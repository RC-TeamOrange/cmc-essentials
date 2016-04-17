
@foreach ($studyMaterials as $studyMaterial)
    <article>
        <h2>{{ $studyMaterial->title }}</h2>
        {!! $studyMaterial->description !!}
    </article>
@endforeach
   
<div class="pager">
{!! with(new CmcEssentials\PaginationPresenter($studyMaterials))->render() !!}

</div>
