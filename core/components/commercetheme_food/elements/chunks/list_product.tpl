<li class="menu-item">
    <div class="menu-item--inner">
        [[+image:notempty=`
        <img class="menu-item-image" src="[[+image:prepend=`/`]]" alt="[[+name:htmlent]]" onerror="this.style.display = 'none'">
        `]]

        <div class="menu-item-content-container">
            <h3 class="menu-item-name">
                [[+name]]
                <span class="menu-item-price">
                    [[+price_rendered]]
                </span>
            </h3>

            <div class="menu-item-content">

                [[+description:notempty=`
                <p class="menu-item-description">[[+description]]</p>
                `]]

                <form action="[[~[[++commerce.cart_resource]]]]" method="post" class="menu-item-form">
                    <input type="hidden" name="add_to_cart" value="1">
                    <input type="hidden" name="product" value="[[+id]]">

                    <div class="menu-item-form-add">

                        <div class="menu-item-quantity">
                            <label for="menu-item-[[+id]]-[[+idx]]-quantity" class="sr-only menu-item-quantity-label">[[%commerce.quantity]]</label>
                            <input type="number" name="quantity" min="1" value="1" id="menu-item-[[+id]]-[[+idx]]-quantity" title="[[%commerce.quantity:htmlent]]" class="menu-item-quantity-input">
                        </div>

                        <button type="submit" class="menu-item-add-button c-button">[[%commerce.add_to_cart]]</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</li>


<!--
<div class="col-md-3 d-flex">
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
        </div>
    </a>
</div>
-->
