<!doctype html>
<html lang="[[++cultureKey]]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="[[!++site_url]]">
    <title>[[*pagetitle]] - [[++site_name]]</title>

    <link rel="stylesheet" href="[[++ctfood.assets_url]]css/main.css">

    [[+extra]]
</head>
<body>


<div class="header">
    <nav class="nav">
        <a class="nav--logo" href="[[~[[++site_start]]]]">
            [[- can add an image here instead ]]
            [[++site_name]]
        </a>
        <input type="checkbox" id="nav-toggle" class="nav--toggle">
        <label for="nav-toggle" class="nav--toggler" type="button" aria-controls="navbar-header" aria-label="Toggle menu">
            <span class="icon icon-2x nav--toggler-closed">
                <svg class="" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </span>
            <span class="icon icon-2x nav--toggler-open">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </span>
        </label>
        <div class="nav--inner collapse">
            [[pdoMenu?
            &parents=`0`
            &level=`2`
            &outerClass=`nav-wrapper`
            &rowClass=`nav-item`
            &displayStart=`0`
            &tpl=`@INLINE <li[[+classes]]><a href="[[+link]]" [[+attributes]] class="nav-link">[[+menutitle]]</a>[[+wrapper]]</li>`
            ]]

            <ul class="nav-wrapper nav--right">
                [[!+modx.user.id:lte=`0`:then=`
                <li class="nav-item">
                    <a href="[[~[[++commerce.login_resource]]]]" class="nav-link">
                        [[pdoField?
                        &id=`[[++commerce.login_resource]]`
                        &field=`menutitle`
                        &default=`pagetitle`
                        ]]
                    </a>
                </li>
                `:else=`
                <li class="nav-item">
                    <a href="[[~[[++[[++ctblue.account_page_id]]]]]]" class="nav-link">
                        [[pdoField?
                        &id=`[[++ctblue.account_page_id]]`
                        &field=`menutitle`
                        &default=`pagetitle`
                        ]]
                    </a>

                    [[pdoMenu?
                    &parents=`[[++ctblue.account_page_id]]`
                    &level=`1`
                    &outerClass=`nav-wrapper`
                    &rowClass=`nav-item`
                    &displayStart=`0`
                    &tpl=`@INLINE <li[[+classes]]><a href="[[+link]]" [[+attributes]] class="nav-link">[[+menutitle]]</a>[[+wrapper]]</li>`
                ]]
                </li>
                `]]

                [[!commerce.get_cart?
                &itemTpl=`ctblue.minicart_item`
                &toPlaceholders=`cart`
                ]]
                <li class="nav-minicart minicart" style="[[!+cart.total_quantity:eq=`0`:then=`display: none;`]]">

                    <input type="checkbox" class="minicart__toggler" id="minicart-header-toggler">
                    <label for="minicart-header-toggler" class="minicart__label">
                    <span class="icon icon-1.5x">
                        <svg class="" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </span>
                        <span class="minicart__toggler-count">[[!%commerce.order.item_count? &quantity=`<span class="minicart__quantity">[[!+cart.total_quantity]]</span>`]]</span>
                    </label>
                    <div class="minicart__wrapper bg-light text-dark">
                        <ul class="minicart__items">
                            <li class="minicart__loading-items">
                            <span class="icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                            </span>
                            </li>
                        </ul>

                        <form class="minicart__footer" method="post" action="[[~[[++commerce.checkout_resource]]]]">
                            <input type="hidden" name="checkout" value="1">

                            <div href="[[~[[++commerce.cart_resource]]]]" class="minicart__summary" title="View your cart">
                            <span class="minicart__quantity-wrapper">
                                <span class="minicart__total-value">[[!+cart.total_formatted]]</span>,
                                [[!%commerce.order.item_count? &quantity=`<span class="minicart__quantity">[[!+cart.total_quantity]]</span>`]]
                            </span>
                            </div>

                            <a href="[[~[[++commerce.cart_resource]]]]" class="minicart__cart">[[!%checkout.step_cart]]</a>
                            <button type="submit" href="[[~[[++commerce.checkout_resource]]]]" class="minicart__checkout">[[!%commerce.checkout]]</button>
                        </form>
                    </div>
                </li>
        </div>
    </nav>
</div>
