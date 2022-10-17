/*jshint browser:true jquery:true*/
/*global alert*/
define(
    [
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils',
        'Magento_Checkout/js/model/totals',
        'Magento_Checkout/js/action/get-totals',
        'ko',
        'jquery',
        'mage/url',
        'Magento_Checkout/js/model/cart/totals-processor/default',
        'Magento_Checkout/js/model/cart/cache'
    ],
    function (Component, quote, priceUtils, totals, getTotalsAction, ko, $, url, defaultTotal, cartCache) {
        "use strict";
        return Component.extend({
            defaults: {
                isFullTaxSummaryDisplayed: window.checkoutConfig.isFullTaxSummaryDisplayed || false,
                template: 'Dev_CheckoutFields/checkout/summary/donate'
            },
            totals: quote.getTotals(),
            isTaxDisplayedInGrandTotal: window.checkoutConfig.includeTaxInGrandTotal || false,
            isDisplayed: function () {
                return this.isFullMode();
            },
            checkValue: function () {
                let price = 0;
                if (this.totals()) {
                    price = totals.getSegment('donate').value;
                    if(price > 0){
                        return this;
                    }
                }
            },
            getValue: function () {
                let price = 0;
                if (this.totals()) {
                    price = totals.getSegment('donate').value;
                }
                return this.getFormattedPrice(price);
            },
            removeDonate: function (){
            let donate = 0;
            let linkUrls = url.build('checkoutfields/index/removedonate');
            $.ajax({
                showLoader: true,
                url: linkUrls,
                data: {remove_donate: donate},
                type: "POST",
                dataType: 'json'
                }).done(function (data) {
                });
                cartCache.set('totals',null);
                defaultTotal.estimateTotals();
                return this;
            },
            getBaseValue: function () {
                let price = 0;
                if (this.totals()) {
                    price = this.totals().base_donate;
                }
                return priceUtils.formatPrice(price, quote.getBasePriceFormat());
            }
        });
    }
);
