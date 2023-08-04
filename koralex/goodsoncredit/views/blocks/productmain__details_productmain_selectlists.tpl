[{oxstyle include=$oViewConf->getModuleUrl("klxgoodsoncredit", "assets/css/fancybox.css")}]
[{oxstyle include=$oViewConf->getModuleUrl("klxgoodsoncredit", "assets/css/style.css")}]
[{oxscript include=$oViewConf->getModuleUrl("klxgoodsoncredit", "assets/js/script.js")}]
[{oxscript include=$oViewConf->getModuleUrl("klxgoodsoncredit", "assets/js/fancybox.umd.js")}]

[{if $oDetailsProduct->isInstallmentable()}]
    [{assign var="sLang" value=$oViewConf->getActLanguageAbbr()}]
    [{if $sLang == 'en'}]
        [{assign var="prepaymentBanner" value="filter_credit_en.svg"}]
        [{assign var="prepaymentPopupBanner" value="filter_credit_popup_en.svg"}]
    [{elseif $sLang == 'de'}]
        [{assign var="prepaymentBanner" value="filter_credit_de.svg"}]
        [{assign var="prepaymentPopupBanner" value="filter_credit_popup_de.svg"}]
    [{/if}]
    [{assign var="krxFinanceImage" value=$oViewConf->getModuleUrl("klxgoodsoncredit", "assets/img/$prepaymentBanner")}]
    [{assign var="krxPrepaymentPopupBanner" value=$oViewConf->getModuleUrl("klxgoodsoncredit", "assets/img/$prepaymentPopupBanner")}]

    <div class="installment">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-6">
                <a href="#" data-fancybox data-src="#filter_credit_popup_content" class="installment_banner">
                    <img src="[{$krxFinanceImage}]" class="installment_banner_image" alt="banner">
                </a>
            </div>
        </div>
    </div>

    <!-- PopUp window -->
    <div id="filter_credit_popup_content" class="white-popup fancybox-content" style="display: none;">
        <button data-fancybox-close="" class="fancybox-close-small" title="Close">
            <svg viewBox="0 0 32 32"><path d="M10,10 L22,22 M22,10 L10,22"></path></svg>
        </button>
        <div class="popup_title">
            <img src="[{$krxPrepaymentPopupBanner}]" alt="popup">
            <header>[{oxmultilang ident="PREPAYMENT_POPUP_BANNER_HEADER"}]</header>
        </div>
        <div class="popup_content">
            <div class="popup_text no_space">
                <div class="popup_block1 ">
                    [{oxmultilang ident="PREPAYMENT_POPUP_PRODUCT_COST"}]:
                </div>
                <div class="popup_block2">
                    [{$oDetailsProduct->oxarticles__oxprice->value}]  <span class="popup_span">€</span>
                </div>
            </div>
            <div class="popup_text">
                <div class="popup_block1 ">
                    [{oxmultilang ident="PREPAYMENT_POPUP_DOWN_PAYMENT"}]:
                </div>
                <div class="popup_block2">
                    [{$oDetailsProduct->oxarticles__oxprepayment->value}]  <span class="popup_span">€</span>
                </div>
            </div>
            <div class="popup_monthly">
                <div class="popup_block low_size">
                    <div class="popup_block1">
                        [{$oDetailsProduct->getInstallmentBalance()}] <span class="popup_span">€/[{oxmultilang ident="PREPAYMENT_POPUP_MONTH"}]</span>
                    </div>
                    <div class="popup_block2">
                        [{$oDetailsProduct->oxarticles__oxmonthsremain->value}]  [{oxmultilang ident="PREPAYMENT_POPUP_PAYMENTS"}]
                    </div>
                </div>
                <div id="no_bold" class="popup_block mini_size">
                    <div class="popup_block1">
                        [{oxmultilang ident="PREPAYMENT_POPUP_INTEREST_AMOUNT"}]: 0,00 <span class="popup_span">€</span>
                    </div>
                </div>
                <div id="no_bold" class="popup_block mini_size">
                    <div class="popup_block1">
                        [{oxmultilang ident="PREPAYMENT_POPUP_ANNUAL_INTEREST_RATE"}]: 0,00  <span class="popup_span">%</span>
                    </div>
                </div>
            </div>
            <div class="popup_info">
                <p>1. [{oxmultilang ident="PREPAYMENT_POPUP_DESCRIPTION_PARAGRAPH_1"}]</p>
                <p>2. [{oxmultilang ident="PREPAYMENT_POPUP_DESCRIPTION_PARAGRAPH_2"}]</p>
                <p>3. [{oxmultilang ident="PREPAYMENT_POPUP_DESCRIPTION_PARAGRAPH_3"}]</p>
            </div>
            <div class="popup_logo">
                [{assign var="slogoImg" value=$oViewConf->getViewThemeParam('sLogoFile')}]
                <img src="[{$oViewConf->getImageUrl($slogoImg)}]" alt="logo">
            </div>
        </div>
    </div>



[{/if}]

<!-- Native code -->
[{if $oViewConf->showSelectLists()}]
    [{assign var="oSelections" value=$oDetailsProduct->getSelections()}]
    [{if $oSelections}]
    <div class="selectorsBox js-fnSubmit clear" id="productSelections">
        [{foreach from=$oSelections item=oList name=selections}]
        [{include file="widget/product/selectbox.tpl" oSelectionList=$oList sFieldName="sel" iKey=$smarty.foreach.selections.index blHideDefault=true sSelType="seldrop"}]
        [{/foreach}]
    </div>
    [{/if}]
[{/if}]
