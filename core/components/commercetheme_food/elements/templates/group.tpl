[[$ctfood.header?
    &extra=``
    &showBreadcrumbs=`1`
]]

<main role="main" class="container">
    <div class="row">
        <div class="col-md-3 col-lg-2">

        </div>
        <div class="col-md-9 col-lg-10">
            <h1 class="category__header">[[*longtitle:default=`[[*pagetitle]]`]]</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-2">
            <aside>
                [[pdoResources?
                    &parents=`0`
                    &context=`[[*context_key]]`
                    &where=`{"template:=":[[++ctfood.category_template]]}`
                    &depth=`0`
                    &tpl=`ctfood.category_list_chunk`
                    &tplWrapper=`ctfood.category_list_outer_chunk`
                    &wrapIfEmpty=`0`
                ]]
                [[!TaggerGetTags?
                    &parents=`[[*id]]`
                    &rowTpl=`ctfood.tag_list_chunk`
                    &outTpl=`ctfood.tag_outer_chunk`
                    &wrapIfEmpty=`0`
                ]]
            </aside>
        </div>
        <div class="col-md-9 col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    [[*content]]
                </div>
            </div>
            <div class="row">
                [[!pdoPage?
                    &parents=`[[*id]]`
                    &depth=`1`
                    &showHidden=`0`
                    &includeTVs=`product_matrix`
                    &tpl=`ctfood.category_list`
                    &limit=`12`
                    &ajaxMode=`default`
                    &where=`[[!TaggerGetResourcesWhere]]`
                ]]
                <div class="col-md-12">
                    [[!+page.nav]]
                </div>
            </div>
        </div>
    </div>

</main>

[[$ctfood.footer?
    &extra=``
]]
