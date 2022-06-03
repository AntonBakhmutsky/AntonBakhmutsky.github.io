<div {{ $attributes->merge(['class' => 'product-form']) }}>
    <x-global.form :title="$title" class="form_product" image="assets/img/contacts-angel.png" :productId="$productId"/>
    <div class="container">
        <div class="product-form__decor product-form__decor_left lazyload"></div>
        <div class="product-form__decor product-form__decor_right lazyload"></div>
    </div>
</div>