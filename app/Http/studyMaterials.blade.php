var_dump($studyMaterials);
@foreach ($studyMaterials as $studyMaterial)

    <article>
        <h2>{{ $studyMaterial->title }} Us</h2>
        {!! $studyMaterial->description !!}
    </article>

@endforeach

{{ $studyMaterials->links() }}