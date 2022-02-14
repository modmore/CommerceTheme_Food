[[$ctfood.header?
&extra=``
&showBreadcrumbs=`0`
]]

<div class="hero" style="background-image: url([[*ctfood.hero_image]]);">
    <div class="hero-content">
        <div class="hero-content--inner">
            [[*ctfood.hero_content]]
        </div>
    </div>
</div>

<div class="subhero">
    <ul class="subhero-container">
        <li class="subhero-item">
            <span class="subhero-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </span>
            Free delivery from <b>€20</b>
        </li>
        <li class="subhero-item">
            <span class="subhero-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" />
                </svg>
            </span>
            Delivery in <b>zip codes 8922-8936</b>
        </li>
        <li class="subhero-item">
            <span class="subhero-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
            </span>
            <b>40-60 minutes</b>
        </li>
    </ul>
</div>

[[*content:notempty=`
<div class="container">
    [[*content]]
</div>
`]]

<div class="container">
    <div class="order-container">
        <section role="main" class="order-menu">
            [[!pdoResources?
            &parents=`[[*id]]`
            &context=`[[*context_key]]`
            &limit=`0`
            &includeTVs=`products,ctfood_featured_product`
            &prepareTVs=`1`
            &tpl=`ctfood.list_groups`
            &sortby=`menuindex`
            &sortdir=`ASC`
            ]]
        </section>


        <aside class="order-list">
            <div class="order-list--inner">
                [[!commerce.cart]]
            </div>
        </aside>
    </div>
</div>



[[$ctfood.footer?
&extra=``
]]
