/**
 * Plugin to handle all the dynamic features of a product
 */

(function ($) {

  'use strict';

  var pluginName = 'product',
    namespace = 'plugin_' + pluginName;

  /**
   * The Plugin constructor
   * @constructor
   * @param {HTMLElement} element The element that will be monitored
   * @param {object} options The plugin options
   */
  function Plugin(element, options) {
    this.element = $(element);
    this.enableHistoryState = options['enableHistoryState'];
    this.product = options['product'];
    this.selectedVariantId = options['selectedVariantId'];

    // Some formatters that are quite useful...
    rivets.formatters.is_variant_on_sale = function(value) {
      if (!value || value['compare_at_price'] === null) {
        return false;
      }

      return value['available'] && value['compare_at_price'] > value['price'];
    };

    rivets.formatters.is_variant_sold_out = function(value) {
      if (!value) {
        return false;
      }

      return value['available'];
    };

    rivets.formatters.does_variant_exist = function(value) {
      return value !== null;
    };

    rivets.formatters.does_variant_not_exist_or_sold_out = function(value) {
      return !value || value['available'];
    };

    rivets.formatters.max_allowed_quantity = function(value) {
      if (!value) {
        return null;
      }

      if (value['inventory_management'] && value['inventory_policy'] === 'deny') {
        return value['inventory_quantity'];
      }

      return null;
    };

    rivets.formatters.sale_percent = function(value) {
      if (!value) {
        return false;
      }

      return - Math.round((value['compare_at_price'] - value['price']) * 100 / value['compare_at_price']) + '%';
    };

    this._init();
  }

  /**
   * Init the plugin
   */
  Plugin.prototype._init = function() {
    // We bind the whole data using Rivets
    this.rivetsBinder = rivets.bind(this.element, {
      product: this.product,
      Currency: window.Currency
    });

    // Add a listener when clicking the add to cart button
    
      this.element.find('[data-action="add-to-cart"]').on('click', $.proxy(this.addToCart, this));
      this.element.find('[data-action="close-form-status"]').on('click', function(e) {
        $(e.currentTarget).closest('.product__form-status').slideUp();
        e.preventDefault();
      });
    

    // Init the option selectors
    if (this.product['variants'].length > 1) {
      var optionSelectors = new Shopify.OptionSelectors('product-select-' + this.product['id'], {
        product: this.product,
        onVariantSelected: $.proxy(this.onVariantSelected, this),
        enableHistoryState: this.enableHistoryState
      });

      optionSelectors.selectVariant(this.selectedVariantId);

      var productForm = this.element.find('.product__form');

      // If there is only one option, Shopify OptionSelector does not add the label, so we do it
      if (this.product['options'].length === 1) {
        productForm.find('#product-select-' + this.product['id'] + '-option-0').before(
          '<label for="product-select-' + this.product['id'] + '-option-0">' + this.product['options'][0] + '</label>'
        );
      }

      // We add our own classes for easier styling
      var selectorWrappers = productForm.find('.selector-wrapper'),
        selectorLabels = selectorWrappers.find('label'),
        selectorSelects = selectorWrappers.find('select');

      selectorWrappers.addClass('form__control');
      selectorLabels.addClass('form__label');

      selectorSelects.wrap('<div class="form__select"></div>')
        .before('<svg class="icon icon-arrow-bottom"><use xlink:href="#icon-arrow-bottom"></use></svg>');
    } else {
      this.onVariantSelected(this.product['variants'][0]);
    }

    

    // Finally, let's integrate with color swatch
    
      this.element.find('.swatch__item').on('click', function() {
        var optionIndex = $(this).closest('.swatch').attr('data-option-index'),
            optionValue = $(this).find(':radio').val();

        $(this).siblings().removeClass('swatch__item--active').end().addClass('swatch__item--active');

        $(this).closest('.product__form').find('.single-option-selector')
          .eq(optionIndex).val(optionValue).trigger('change');
      });
    
  };

  /**
   * Called when the variant changes
   */
  Plugin.prototype.onVariantSelected = function(variant) {
    this.selectedVariant = variant;
    this.rivetsBinder.models['selected_variant'] = this.selectedVariant;

    if (variant) {
      

      // Let's update the swatch
      
        for (var i = 0, length = variant.options.length; i < length; i++) {
          var valueToCheck = variant.options[i];

          var radioButton = this.element.find('.swatch[data-option-index="' + i + '"] :radio').filter(function() {
            return $(this).val() === valueToCheck;
          });

          if (radioButton.size()) {
            radioButton.attr('checked', 'checked').closest('.swatch__item').addClass('swatch__item--active').siblings().removeClass('swatch__item--active');
          }
        }
      

      // We trigger an event so that other code can bind their own logic
      $(document).trigger('variant.changed', variant);
    }
  };

  /**
   * Called when the product is added to the cart
   */
  Plugin.prototype.addToCart = function() {
    var formData = this.serializeForm(this.element.find('.product__form')),
        self = this;

    this.rivetsBinder.models['is_adding_to_cart'] = true;
    this.rivetsBinder.models['added_error_message'] = null;

    var afterRequest = function(data, textStatus, jqXhr) {
      self.rivetsBinder.models['is_adding_to_cart'] = false;
      self.element.find('.product__form-status').slideDown();
    };

    CartJS.addItem(formData['id'], formData['quantity'], formData['properties'], {
      success: function(data, textStatus, jqXhr) {
        afterRequest(data, textStatus, jqXhr);
      },

      error: function(data, textStatus, jqXhr) {
        self.rivetsBinder.models['added_error_message'] = data.responseJSON['description'];
        afterRequest(data, textStatus, jqXhr);
      }
    });

    return false;
  };

  Plugin.prototype.serializeForm = function(form) {
    var hash = {};

    function stringKey(key, value) {
      var beginBracket = key.lastIndexOf('[');
      if (beginBracket == -1) {
        var hash = {};
        hash[key] = value;
        return hash;
      }
      var newKey = key.substr(0, beginBracket),
        newValue = {};
      newValue[key.substring(beginBracket + 1, key.length - 1)] = value;

      return stringKey(newKey, newValue);
    }

    var els = form.find(':input').get();

    $.each(els, function() {
      if (this.name && !this.disabled && (this.checked || /select|textarea/i.test(this.nodeName) || /hidden|text|search|tel|url|email|password|datetime|date|month|week|time|datetime-local|number|range|color/i.test(this.type))) {
        var val = $(this).val();
        $.extend(true, hash, stringKey(this.name, val));
      }
    });

    return hash;
  };

  $.fn[pluginName] = function(options) {
    var method = false,
      methodArgs = arguments;

    if (typeof options == 'string') {
      method = options;
    }

    return this.each(function() {
      var plugin = $.data(this, namespace);

      if (!plugin && !method) {
        $.data(this, namespace, new Plugin(this, options));
      } else if (method) {
        callMethod(plugin, method, Array.prototype.slice.call(methodArgs, 1));
      }
    });
  };
}(jQuery));

/**
 * JQuery Pick (used to display related products)
 */
(function( $ ){
  $.fn.pick = function(count) {

    var howMany = count || 4;

    // Picking random numbers without repeating.
    var index_array = [];
    var original_obj_size = this.size();
    for (var i=0; i<original_obj_size; i++) {
      index_array.push(i);
    }
    //+ Jonas Raoni Soares Silva
    //@ http://jsfromhell.com/array/shuffle [rev. #1]
    var shuffle = function(v) {
      for (var j, x, i = v.length; i; j = parseInt(Math.random() * i), x = v[--i], v[i] = v[j], v[j] = x);
      return v;
    };
    var new_index_array = shuffle(index_array).slice(0,howMany);

    // Ditching unpicked elements and removing those from the returned set.
    return this.each(function(i) {
      if ($.inArray(i,new_index_array) === -1) {
        $(this).remove();
      } else {
        var image = $(this).find('.product-item__image');
        image.attr('src', image.attr('data-src'));
      }
    }).filter(function() {
      if (this.parentNode === null) {
        return false;
      }
      else {
        return true;
      }
    });

  };
})( jQuery );
var router = new RouterRouter();

router.route('account/addresses', function() {
  /**
   * -------------------------
   * MODALS
   * -------------------------
   */

  $('[data-action="open-new-address-modal"]').on('click', function(e) {
    $('.addresses__new').bPopup({
      positionStyle: 'fixed',
      closeClass: 'addresses__close',
      transition: 'slideDown',
      transitionClose: 'slideUp'
    });

    e.preventDefault();
  });

  $('[data-action="open-edit-address-modal"]').on('click', function(e) {
    $('.addresses__edit[data-address="' + $(this).attr('data-address') + '"]').bPopup({
      positionStyle: 'fixed',
      closeClass: 'addresses__close',
      transition: 'slideDown',
      transitionClose: 'slideUp'
    });

    e.preventDefault();
  });
});
router.route('*all', function() {
  var pageOverlay=  $('.page__overlay');

  /**
   * -------------------------
   * MOBILE NAV
   * -------------------------
   */

  $('.header__mobile-icon').on('click', function(event) {
    var element = $(this);

    // If no content to display, we want the user to be redirected to the page
    if (element.attr('data-has-menu') === 'false') {
      return;
    }

    var tab = element.closest('.header__mobile-tab');

    // We close the other tab (if any open) and add the class to itself
    tab.siblings().removeClass('header__mobile-tab--open').find('.header__mobile-content').slideUp(0);

    tab.toggleClass('header__mobile-tab--open');
    tab.find('.header__mobile-content').slideToggle(150);

    if (tab.hasClass('header__mobile-tab--open')) {
      pageOverlay.addClass('page__overlay--open');
      tab.find('.mobile-search__input').focus();
    } else {
      pageOverlay.removeClass('page__overlay--open');
      tab.find('.mobile-search__input').blur();
    }

    event.preventDefault();
  });

  $('.menu__icon-container').on('click', function(event) {
    var menu = $(this).closest('.menu__item');

    menu.toggleClass('menu__item--open');

    if (menu.hasClass('menu__item--open')) {
      menu.children('.menu__links').slideDown();
    } else {
      menu.find('.menu__links').slideUp();
      menu.find('.menu__item--open').removeClass('menu__item--open');
    }

    event.preventDefault();
  });

  bouncefix.add('header__mobile-content');

  $('.header__mobile-nav').Stickyfill();

  /**
   * -------------------------
   * MEGA NAV
   * -------------------------
   */

  

  /**
   * -------------------------
   * QUICK SHOP
   * -------------------------
   */

  
    $('body').on('click', '[data-action="open-quick-shop"]', function() {
      // We get the ID of the product
      var productId = $(this).attr('data-product-id');

      // We get the corresponding quick shop. Because multiple may exist in the page, we only display the first one
      $('.quick-shop[data-product-id="' + productId + '"]').first().bPopup({
        positionStyle: 'fixed',
        onOpen: function() {
          var quickShop = $(this),
              isInitialized = quickShop.attr('data-initialized');

          // First, let's initialize the various resources (images, and slideshow)
          if (isInitialized === 'false') {
            var slider = quickShop.find('.quick-shop__slideshow').slick({
              fade: true,
              adaptiveHeight: true,
              lazyLoad: 'progressive',
              arrows: false,
              dots: false
            }).slick('getSlick');

            // Finally, let's initialize the product selectors
            window['initializeQuickShop' + productId]();

            $(document).on('variant.changed', function(event, variant) {
              if (variant['featured_image']) {
                var position = quickShop.find('.quick-shop__slideshow-slide[data-image-id="' + variant['featured_image']['id'] + '"]').index();
                slider.goTo(position);
              }
            });

            quickShop.attr('data-initialized', 'true');
          }
        }
      });

      return false;
    });
  
  
  /**
   * -------------------------
   * AUTOMATIC CURRENCY CONVERSION
   * -------------------------
   */

  
    var shopCurrency = window.shop.shopCurrency,
      currencySelector = $('.currency-selector__select');

    // Sometimes merchants change their shop currency, let's tell our JavaScript file
    Currency.moneyFormats[shopCurrency].money_with_currency_format = window.shop.moneyWithCurrencyFormat;
    Currency.moneyFormats[shopCurrency].money_format = window.shop.moneyFormat;

    // Default currency
    var defaultCurrency = "EUR" || shopCurrency;

    // Cookie currency
    var cookieCurrency = Currency.cookie.read();

    // If there's no cookie.

    if (cookieCurrency == null) {
      if (shopCurrency !== defaultCurrency) {
        Currency.convertAll(shopCurrency, defaultCurrency);
      } else {
        Currency.currentCurrency = defaultCurrency;
      }
    } else if (currencySelector.size() && currencySelector.find('option[value=' + cookieCurrency + ']').size() === 0) {
      // If the cookie value does not correspond to any value in the currency dropdown.
      Currency.currentCurrency = shopCurrency;
      Currency.cookie.write(shopCurrency);
    } else if (cookieCurrency === shopCurrency) {
      Currency.currentCurrency = shopCurrency;
    } else {
      Currency.convertAll(shopCurrency, cookieCurrency);
    }

    currencySelector.val(Currency.currentCurrency).change(function() {
      var newCurrency = $(this).val();
      Currency.convertAll(Currency.currentCurrency, newCurrency);

      $('.selected-currency').text(Currency.currentCurrency);
    });
  

  /**
   * -------------------------
   * MARKETING POPUP
   * -------------------------
   */

  
    // We create the modal after the specified amount of time
    setTimeout(function() {
      if (!$.cookie('marketing_popup_seen')) {
        var marketingPopup = $('.marketing-popup');

        if (marketingPopup.length === 0) {
          return;
        }

        marketingPopup.bPopup({
          positionStyle: 'fixed',
          closeClass: 'modal__close',
          opacity: 0.5,
          transition: 'slideDown',
          transitionClose: 'slideDown'
        });

        // We save into the cookie in order to avoid annoying the user
        $.cookie('marketing_popup_seen', true, {expires: 0 });
      }
    }, 0);
  

  /**
   * -------------------------
   * SEARCH
   * -------------------------
   */

  $('[data-action="open-mega-search"]').on('click', function() {
    $('.mega-search').bPopup({
      positionStyle: 'fixed',
      closeClass: 'icon-cross',
      opacity: 0.8,
      position: ['auto', 200],
      onOpen: function() {
        setTimeout(function() {$('.mega-search__input').focus()}, 0);
      }
    });

    return false;
  });

  // Let's trigger the auto-complete
  var autocompleteXhr,
      suggestionsBinder = rivets.bind($('.mega-search'), {
        loading: false,
        suggestions: [],
        Currency: window.Currency
      });

  $('.mega-search__input').autoComplete({
    minChars: 1,
    delay: 50,

    // Function that is called to get suggestions from Shopify
    source: function(term, done) {
      try {
        autocompleteXhr.abort();
      } catch(e) {}

      suggestionsBinder.models['loading'] = true;

      var searchData = {
        q: term + '*', // We automatically add wildcard for partial matching
        view: 'json'
      };

      if (window.features.searchMode === 'products') {
        searchData['type'] = 'product';
      }

      autocompleteXhr = $.ajax({
        url: '/search',
        dataType: 'json',
        data: searchData
      }).then(function(data) {
        suggestionsBinder.models['suggestions'] = data;
        suggestionsBinder.models['loading'] = false;
      });
    },

    // Function called when an element is selected
    onSelect: function(e, term, item) {
      location.href = item.attr('data-url');
      e.preventDefault();
    }
  });

  /**
   * -------------------------
   * ALTERNATE IMAGES
   * -------------------------
   */

  // Focal offers a feature where people can hover a collection item and display an alternate image. This can happen
  // in various pages (home, collection, search, product...). The trick is that touch devices do not have hover, so
  // it's useless to load alternate images for those devices. Instead, we add alternate images tag for non-touch
  // devices, which will start loading the alternate images
  if (!Modernizr.touchevents) {
    $('.product-item:not(.related-products__item) .product-item__image[data-alternate-src]').each(function(index, item) {
      var image = $(item),
        alternateImage = new Image();

      alternateImage.src = image.attr('data-alternate-src');
      alternateImage.className = 'product-item__image product-item__image--alternate';

      alternateImage.onload = function() {
        image.after(alternateImage);
        image.closest('.product-item__figure').addClass('product-item__figure--alternate-image-loaded');
      };
    });
  }
});
router.route('cart', function() {
  // Add the note using CartJS
  $('.cart__note').on('change', function() {
    CartJS.setNote($(this).val());
  });

  $('.cart-item__quantity').on('change', function() {
    // We add one because Shopify uses 1-index numbering
    var element = $(this),
        lineIndex = parseInt(element.closest('.cart-item').attr('data-index')) + 1;

    CartJS.updateItem(lineIndex, element.val());
  });

  /**
   * -------------------------
   * TERMS AND CONDITIONS
   * -------------------------
   */

  
    $('input[name="checkout"]').on('click', function() {
      if (!$('#terms').is(':checked')) {
        alert("You need to accept terms and conditions");
        return false;
      }
    });
  
  
  /**
   * -------------------------
   * SHIPPING ESTIMATOR
   * -------------------------
   */

  var shippingEstimator = $('.shipping-estimator');

  $('.shipping-estimator__submit').on('click', function() {
    CartJS.settings.rivetsModels.shipping['is_submitting'] = true;

    $.ajax({
      method: 'GET',
      url: '/cart/shipping_rates.json',
      data: {
        shipping_address: {
          country: shippingEstimator.find('#address_country').val(),
          province: shippingEstimator.find('#address_province').val(),
          zip: shippingEstimator.find('#address_zip').val()
        }
      }
    }).done(function(results) {
      // Shopify return rates already formatted in the shop currency, but we need to multiply them by 100
      results['shipping_rates'].forEach(function(item, index) {
        results['shipping_rates'][index]['price'] *= 100;
      });

      if (results['shipping_rates'].length > 0) {
        CartJS.settings.rivetsModels.shipping.first_price = results['shipping_rates'][0]['price'];
      }

      CartJS.settings.rivetsModels.shipping['is_submitting'] = false;
      CartJS.settings.rivetsModels.shipping['has_rates'] = true;
      CartJS.settings.rivetsModels.shipping['has_errors'] = false;
      CartJS.settings.rivetsModels.shipping['rates'] = results['shipping_rates'];
    }).error(function(results) {
      var response = results.responseJSON,
        errors = [];

      for (var key in response) {
        if (response.hasOwnProperty(key)) {
          errors.push({key: key, value: response[key][0]});
        }
      }

      CartJS.settings.rivetsModels.shipping['is_submitting'] = false;
      CartJS.settings.rivetsModels.shipping['has_rates'] = true;
      CartJS.settings.rivetsModels.shipping['has_errors'] = true;
      CartJS.settings.rivetsModels.shipping['errors'] = errors;
    });

    return false;
  });

  new Shopify.CountryProvinceSelector('address_country', 'address_province', {hideElement: 'address_province_container'});
});
router.route('collections/*type', function() {
  /**
   * -------------------------
   * SORT BY AND FILTERS
   * -------------------------
   */

  Shopify.queryParams = {};

  $('.header__push-filter--sort select').val(window.shop.collectionSortBy).on('change', function () {
    Shopify.queryParams.sort_by = $(this).val();
    location.search = decodeURIComponent($.param(Shopify.queryParams));
  });

  if (location.search.length) {
    for (var aKeyValue, i = 0, aCouples = location.search.substr(1).split('&'); i < aCouples.length; i++) {
      aKeyValue = aCouples[i].split('=');

      if (aKeyValue.length > 1) {
        Shopify.queryParams[decodeURIComponent(aKeyValue[0])] = decodeURIComponent(aKeyValue[1]);
      }
    }
  }

  $('.header__push-filter--tags select').on('change', function (event) {
    window.location.href = $(event.currentTarget).find(':selected').val();
  });

  /**
   * -------------------------
   * PAGINATION MODE
   * -------------------------
   */

  
    $('.collection__list').infiniteScrollHelper({
      loadingClassTarget: '.collection__loader',
      loadingClass: 'collection__loader--loading',
      startingPageCount: window.shop.currentPage,
      hasMore: true,

      loadMore: function(page, done) {
        var loadingTarget = $(this.loadingClassTarget);

        if (!this.hasMore || loadingTarget.length == 0) {
          done();
          return;
        }

        var targetUrl = $.query.load(loadingTarget.attr('data-next-page'));

        // We need to modify the "page" attribute of the fetched URL
        targetUrl = targetUrl.set('page', page);

        $.ajax({
          url: location.protocol + '//' + location.host + location.pathname,
          data: targetUrl.toString().slice(1) // Allow to remove the initial "?" character
        }).then(function(content) {
          done();

          // Check if there is still content to load
          if (content.trim() == '') {
            $('.collection__list').infiniteScrollHelper('destroy');
            loadingTarget.remove();
          } else {
            var domContent = $(content);

            if (!Modernizr.touchevents) {
              domContent.find('.product-item__image[data-alternate-src]').each(function(index, item) {
                var image = $(item),
                  alternateImage = new Image();

                alternateImage.src = image.attr('data-alternate-src');
                alternateImage.className = 'product-item__image product-item__image--alternate';

                alternateImage.onload = function() {
                  image.after(alternateImage);
                  image.closest('.product-item__figure').addClass('product-item__figure--alternate-image-loaded');
                };
              });
            }

            // We can append the content to the .collection__list container
            $('.collection__list').append(domContent);
          }
        });
      }
    });
  
});
router.route('', function() {
  var isMobile = Modernizr.mq('(max-width: 48em)');

  /**
   * SLIDESHOW
   */

  
    // $('.slideshow__slides').slick({
    //   autoplay: true,
    //   autoplaySpeed: 4000,
    //   infinite: true,
    //   // adaptiveHeight: true,
    //   // useTransform: true,
    //   // dots: false,
    //   fade: true,
    //   // cssEase: 'linear',
    //   appendArrows: $('.slideshow__slides'),
    //   prevArrow: $('.slideshow__prev'),
    //   nextArrow: $('.slideshow__next'),
    // });

    // // $('.slideshow__prev, .slideshow__next').on('click', function(e) {
    // //   e.preventDefault();
    // // });
  

  /**
   * INSTAGRAM
   */
  
    

    var formatInstagramDate = function(image) {
      var date = new Date(image.created_time * 1000);

      m = date.getMonth();
      d = date.getDate();
      y = date.getFullYear();

      var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

      image.created_time = monthNames[m] + ' ' + d + ', ' + y;

      return true;
    };

    if (isMobile) {
      var resolution = 'low_resolution';
    } else {
      
        var resolution = 'low_resolution';
      
    }

    
      // var feed = new Instafeed({
      //   get: 'user',
      //   userId: 17570841,
      //   accessToken: "111470125.3a81a9f.6316ead977784c2399efe0a3a976ded6",
      //   sortBy: 'most-recent',
      //   limit: 12,
      //   resolution: resolution,
      //   template: '<div class="instagram__image-wrapper"><a href="{{link}}" target="_blank"><div class="instagram__overlay"><p class="instagram__caption">{{caption}}</p><time class="instagram__date">{{model.created_time}}</time></div><img class="instagram__image" src="{{image}}"/></a></div>',
      //   after: function() {
      //     var images = $('.instagram__image-wrapper');
      //
      //     images.filter(':nth-child(2n + 1)').addClass('grid__item--mobile-first');
      //     images.filter(':nth-child(6n + 1)').addClass('grid__item--tablet-first grid__item--desktop-first');
      //   },
      //   filter: $.proxy(formatInstagramDate)
      // });
    

    var displayInstagramOnMobile = false;

    if (!isMobile || (displayInstagramOnMobile && isMobile)) {
      // feed.run();
    }
  
});
/**
 * ----------------------------------------------------------------------------------------------------
 * LOGIN
 * ----------------------------------------------------------------------------------------------------
 */

router.route('account/login', function() {
  /**
   * -------------------------
   * SWITCH TO RECOVER FORM
   * -------------------------
   */

  var switchToRecoverForm = function() {
    $('.account__login, .account__recover').toggle();
    $('.header__push-title').text("Recover your password");
  };

  $('[data-action="display-recover-form"]').on('click', function() {
    switchToRecoverForm();
    return false;
  });

  // We also switch if we directly have the hash "recover"
  if (window.location.hash === '#recover' || window.recoverPassword === true) {
    switchToRecoverForm();
  }
});
/**
 * ----------------------------------------------------------------------------------------------------
 * PRODUCT ROUTE
 * ----------------------------------------------------------------------------------------------------
 */

var productRoute = function() {
  /**
   * -------------------------
   * SLIDESHOW SLIDER
   * -------------------------
   */

  var productSlideshow = $('.product__slideshow--main');

  // Finally, enable the zoom if specified
  
    // For performance reason, we only create the zoom when we reach the slide. Also, if on a small mobile,
    // we remove this feature because it's hard to use
    productSlideshow.on('init afterChange', function(event, slick) {
      var currentSlide = $(slick.$slides[slick.currentSlide]);

      if (!currentSlide.attr('data-slide-initialized') && !Modernizr.touchevents) {
        currentSlide.zoom({
          url: currentSlide.attr('data-image-large-url'),
          touch: false,
          magnify: "1",
          onZoomIn: function() {
            $(this).prev().addClass('product__slideshow-image--zoomed');
          },
          onZoomOut: function() {
            $(this).prev().removeClass('product__slideshow-image--zoomed');
          }
        });
      }
    });
  

  productSlideshow.slick({
    useTransform: true,
    adaptiveHeight: true,
    initialSlide: parseInt(productSlideshow.attr('data-initial-slide')),
    dots: true
  });

  $('.product__slideshow-nav-image').on('click', function(e) {
    productSlideshow.slick('slickGoTo', parseInt($(this).attr('data-slide-index')));
    e.preventDefault();
  });

  // We attach an event whenever the variant changed so we have the opportunity to modify the featured image
  $(document).on('variant.changed', function(event, variant) {
    if (variant['featured_image']) {
      productSlideshow.slick('slickGoTo', variant['featured_image']['position'] - 1);
    }
  });

  /**
   * -------------------------
   * TABS
   * -------------------------
   */

  $('.product__tab-title').on('click', function() {
    var element = $(this),
        tabsContent = element.closest('.product__tabs').find('.product__tabs-content .product__tab-content');

    // If it's already active, do nothing
    if (element.hasClass('product__tab-title--active')) {
      return;
    }

    element.siblings().removeClass('product__tab-title--active').end().addClass('product__tab-title--active');

    tabsContent.filter('.product__tab-content--active').fadeOut(125, function() {
      tabsContent.removeClass('product__tab-content--active').eq(element.attr('data-tab-index')).addClass('product__tab-content--active').fadeIn(125);
    });
  });

  $('.product__tab-selector select').on('change', function() {
    var element = $(this),
      tabsContent = element.closest('.product__tabs').find('.product__tabs-content .product__tab-content');

    tabsContent.filter('.product__tab-content--active').fadeOut(125, function() {
      tabsContent.removeClass('product__tab-content--active').eq(element.val()).addClass('product__tab-content--active').fadeIn(125);
    });
  });

  /**
   * -------------------------
   * RELATED PRODUCTS
   * -------------------------
   */

  
    
    var items = $('.related-products__item').pick(0).show();

    items.find('.product-item__image[data-alternate-src]').each(function(index, item) {
      var image = $(item),
        alternateImage = new Image();

      alternateImage.src = image.attr('data-alternate-src');
      alternateImage.className = 'product-item__image product-item__image--alternate';

      alternateImage.onload = function() {
        image.after(alternateImage);
        image.closest('.product-item__figure').addClass('product-item__figure--alternate-image-loaded');
      };
    });
  
};

router.route('products/*type', productRoute);
router.route('collections/*collection/products/*type', productRoute);
router.route('search', function() {
  /**
   * -------------------------
   * PAGINATION MODE
   * -------------------------
   */

  
    $('.collection__list').infiniteScrollHelper({
      loadingClassTarget: '.collection__loader',
      loadingClass: 'collection__loader--loading',
      startingPageCount: window.shop.currentPage,
      hasMore: true,

      loadMore: function(page, done) {
        var loadingTarget = $(this.loadingClassTarget);

        if (!this.hasMore || loadingTarget.length == 0) {
          done();
          return;
        }

        var targetUrl = $.query.load(loadingTarget.attr('data-next-page'));

        // We need to modify the "page" attribute of the fetched URL
        targetUrl = targetUrl.set('page', page);

        $.ajax({
          url: location.protocol + '//' + location.host + location.pathname,
          data: targetUrl.toString().slice(1) // Allow to remove the initial "?" character
        }).then(function(content) {
          done();

          // Check if there is still content to load
          if (content.trim() == '') {
            $('.collection__list').infiniteScrollHelper('destroy');
            loadingTarget.remove();
          } else {
            var domContent = $(content);

            if (!Modernizr.touchevents) {
              domContent.find('.product-item__image[data-alternate-src]').each(function(index, item) {
                var image = $(item),
                  alternateImage = new Image();

                alternateImage.src = image.attr('data-alternate-src');
                alternateImage.className = 'product-item__image product-item__image--alternate';

                alternateImage.onload = function() {
                  image.after(alternateImage);
                  image.closest('.product-item__figure').addClass('product-item__figure--alternate-image-loaded');
                };
              });
            }

            // We can append the content to the .collection__list container
            $('.collection__list').append(domContent);
          }
        });
      }
    });
  
});