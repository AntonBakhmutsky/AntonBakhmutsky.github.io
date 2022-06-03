@foreach($articles as $article)
  <x-global.article-card :article="$article" :slide="false" :lazy="false"/>
@endforeach

{{ $articles->links() }}
