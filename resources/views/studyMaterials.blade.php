
@foreach ($studyMaterials as $studyMaterial)
    <article>
        <h2>{{ $studyMaterial->title }} Us</h2>
        {!! $studyMaterial->description !!}
    </article>
@endforeach
   
<div class="pager">
{{ $studyMaterials->render() }}
</div>
