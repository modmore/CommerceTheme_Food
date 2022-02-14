<div class="menu-group">
    <div class="menu-header">
        <h2 id="menu-[[+alias]]" class="menu-header--name">[[+longtitle:default=`[[+pagetitle]]`]]</h2>
        [[+introtext:notempty=`<p class="menu-header--description">[[+introtext]]</p>`]]
    </div>

    <ul class="menu-items">
        [[!commerce.get_products?
            &products=`[[+tv.products]]`
            &tpl=`ctfood.list_product`
        ]]
    </ul>
</div>



<!--
<div class="col-md-6 col-lg-6 col-xl-4 d-flex">
    <a class="card category-product__card" href="[[~[[+id]]]]">
        <img class="card-img-top category-product__image"
                onerror="this.style.display = 'none'"
                src="[[!commerce.get_matrix_first_product?
                    &matrix=`[[+tv.product_matrix]]`
                    &withImage=`1`
                    &withStock=`0`
                    &field=`image`
                ]]"
                alt="[[+pagetitle:htmlent]]">
        <div class="card-body category-product__body">
            <h5 class="card-title">
                [[+pagetitle]]
            </h5>
            <p class="card-subtitle mb-2 text-muted">
                [[!commerce.get_matrix_price?
                    &matrix=`[[+tv.product_matrix]]`
                    &getMin=`1`
                    &getMax=`1`
                    &inStockOnly=`1`
                ]]
            </p>
            <p class="card-text">[[+description]]</p>
        </div>
        <div class="card-footer category-product__footer d-flex">
            <button class="btn btn-primary flex-grow-1 mr-3">Learn more</button>
        </div>
    </a>
</div>
-->
