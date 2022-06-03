@foreach($category->products as $item)
  <x-global.product-card :item="$item" :category="$category"/>
@endforeach
{{ $category->products->links() }}

